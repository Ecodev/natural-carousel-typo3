<?php

namespace Fab\NaturalCarousel\Facet;

/*
 * This file is part of the Fab/NaturalCarousel project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */
use Fab\NaturalCarousel\Domain\Repository\ContentRepository;
use Fab\NaturalCarousel\Resolver\FieldPathResolver;
use TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Fab\NaturalCarousel\Domain\Repository\ContentRepositoryFactory;
use Fab\NaturalCarousel\Persistence\MatcherObjectFactory;
use Fab\NaturalCarousel\Tca\Tca;

/**
 * Class for configuring a custom Facet item.
 */
class FacetSuggestionService
{
    /**
     * Retrieve possible suggestions for a field name
     *
     * @param string $fieldNameAndPath
     * @return array
     */
    public function getSuggestions($fieldNameAndPath): array
    {
        $values = [];

        $dataType = $this->getFieldPathResolver()->getDataType($fieldNameAndPath);
        $fieldName = $this->getFieldPathResolver()->stripFieldPath($fieldNameAndPath);

        if (Tca::grid()->facet($fieldNameAndPath)->hasSuggestions()) {
            $values = Tca::grid()->facet($fieldNameAndPath)->getSuggestions();
        } elseif (Tca::table($dataType)->hasField($fieldName)) {
            if (Tca::table($dataType)->field($fieldName)->hasRelation()) {
                // Fetch the adequate repository
                $foreignTable = Tca::table($dataType)->field($fieldName)->getForeignTable();
                $contentRepository = ContentRepositoryFactory::getInstance($foreignTable);
                $table = Tca::table($foreignTable);

                // Initialize the matcher object.
                $matcher = MatcherObjectFactory::getInstance()->getMatcher([], $foreignTable);

                $numberOfValues = $contentRepository->countBy($matcher);
                if ($numberOfValues <= $this->getLimit()) {
                    $contents = $contentRepository->findBy($matcher);

                    foreach ($contents as $content) {
                        $values[] = array($content->getUid() => $content[$table->getLabelField()]);
                    }
                }
            } elseif (!Tca::table($dataType)->field($fieldName)->isTextArea()) { // We don't want suggestion if field is text area.
                // Fetch the adequate repository
                /** @var ContentRepository $contentRepository */
                $contentRepository = ContentRepositoryFactory::getInstance($dataType);

                // Initialize some objects related to the query
                $matcher = MatcherObjectFactory::getInstance()->getMatcher([], $dataType);

                // Count the number of objects.
                $numberOfValues = $contentRepository->countDistinctValues($fieldName, $matcher);

                // Only returns suggestion if there are not too many for the browser.
                if ($numberOfValues <= $this->getLimit()) {
                    // Query the repository.
                    $contents = $contentRepository->findDistinctValues($fieldName, $matcher);

                    foreach ($contents as $content) {
                        $value = $content[$fieldName];
                        $label = $content[$fieldName];
                        if (Tca::table($dataType)->field($fieldName)->isSelect()) {
                            $label = Tca::table($dataType)->field($fieldName)->getLabelForItem($value);
                        }

                        $values[] = $label;
                    }
                }
            }
        }
        return $values;
    }

    /**
     * Return from settings the suggestion limit.
     *
     * @return int
     */
    protected function getLimit(): int
    {
        $settings = $this->getSettings();
        $suggestionLimit = (int)$settings['suggestionLimit'];
        if ($suggestionLimit <= 0) {
            $suggestionLimit = 1000;
        }
        return $suggestionLimit;
    }

    /**
     * @return FieldPathResolver|object
     */
    protected function getFieldPathResolver()
    {
        return GeneralUtility::makeInstance(FieldPathResolver::class);
    }

    /**
     * Returns the module settings.
     *
     * @return array
     */
    protected function getSettings()
    {
        /** @var BackendConfigurationManager $backendConfigurationManager */
        $backendConfigurationManager = GeneralUtility::makeInstance(BackendConfigurationManager::class);
        $configuration = $backendConfigurationManager->getTypoScriptSetup();
        return $configuration['module.']['tx_vidi.']['settings.'];
    }
}
