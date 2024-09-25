<?php

namespace Fab\NaturalCarousel\Processor;

/*
 * This file is part of the Fab/NaturalCarousel project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */
use Fab\NaturalCarousel\Resolver\ContentObjectResolver;
use Fab\NaturalCarousel\Resolver\FieldPathResolver;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Fab\NaturalCarousel\Behavior\SavingBehavior;
use Fab\NaturalCarousel\Domain\Model\Content;
use Fab\NaturalCarousel\Signal\ProcessContentDataSignalArguments;
use Fab\NaturalCarousel\Tca\Tca;

/**
 * Class for retrieving value from an object.
 * Non trivial case as the field name could contain a field path, e.g. metadata.title
 */
class ContentObjectProcessor implements SingletonInterface
{
    /**
     * @param ProcessContentDataSignalArguments $signalArguments
     * @return array
     */
    public function processRelations(ProcessContentDataSignalArguments $signalArguments)
    {
        $contentObject = $signalArguments->getContentObject();
        $fieldNameAndPath = $signalArguments->getFieldNameAndPath();
        $contentData = $signalArguments->getContentData();
        $savingBehavior = $signalArguments->getSavingBehavior();

        if ($savingBehavior !== SavingBehavior::REPLACE) {
            $contentData = $this->appendOrRemoveRelations($contentObject, $fieldNameAndPath, $contentData, $savingBehavior);
            $signalArguments->setContentData($contentData);
        }

        return array($signalArguments);
    }

    /**
     * @param Content $object
     * @param $fieldNameAndPath
     * @param array $contentData
     * @param string $savingBehavior
     * @return array
     */
    protected function appendOrRemoveRelations(Content $object, $fieldNameAndPath, array $contentData, $savingBehavior)
    {
        foreach ($contentData as $fieldName => $values) {
            $resolvedObject = $this->getContentObjectResolver()->getObject($object, $fieldNameAndPath);

            if (Tca::table($resolvedObject)->field($fieldName)->hasMany()) {
                // true means CSV values must be converted to array.
                if (!is_array($values)) {
                    $values = GeneralUtility::trimExplode(',', $values);
                }
                $relatedValues = $this->getRelatedValues($object, $fieldNameAndPath, $fieldName);

                foreach ($values as $value) {
                    $appendOrRemove = $savingBehavior . 'Relations';
                    $relatedValues = $this->$appendOrRemove($value, $relatedValues);
                }

                $contentData[$fieldName] = $relatedValues;
            }
        }
        return $contentData;
    }

    /**
     * @param $value
     * @param array $relatedValues
     * @return array
     */
    protected function appendRelations($value, array $relatedValues)
    {
        if (!in_array($value, $relatedValues)) {
            $relatedValues[] = $value;
        }
        return $relatedValues;
    }

    /**
     * @param $value
     * @param array $relatedValues
     * @return array
     */
    protected function removeRelations($value, array $relatedValues)
    {
        if (in_array($value, $relatedValues)) {
            $key = array_search($value, $relatedValues);
            unset($relatedValues[$key]);
        }
        return $relatedValues;
    }

    /**
     * @param Content $object
     * @param string $fieldNameAndPath
     * @param string $fieldName
     * @return array
     */
    protected function getRelatedValues(Content $object, $fieldNameAndPath, $fieldName)
    {
        $values = [];
        $relatedContentObjects = $this->getContentObjectResolver()->getValue($object, $fieldNameAndPath, $fieldName);

        if (is_array($relatedContentObjects)) {
            /** @var Content $relatedContentObject */
            foreach ($relatedContentObjects as $relatedContentObject) {
                $values[] = $relatedContentObject->getUid();
            }
        }

        return $values;
    }

    /**
     * @return ContentObjectResolver|object
     */
    protected function getContentObjectResolver()
    {
        return GeneralUtility::makeInstance(ContentObjectResolver::class);
    }

    /**
     * @return FieldPathResolver|object
     */
    protected function getFieldPathResolver()
    {
        return GeneralUtility::makeInstance(FieldPathResolver::class);
    }
}
