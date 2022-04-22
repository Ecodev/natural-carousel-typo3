<?php
namespace Fab\NaturalCarousel\ViewHelpers;

/**
 * This file is part of the TYPO3 CMS project.
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * The TYPO3 project - inspiring people to share!
 */

use Fab\Vidi\Domain\Model\Content;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ProcessedFile;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * View helper
 */
class SlideStackViewHelper extends AbstractViewHelper
{

    /**
     * @return string
     */
    public function render()
    {
        $slides = $this->templateVariableContainer->get('slides');

        $items = [];
        /** @var \TYPO3\CMS\Core\Resource\FileReference $slide */
        foreach ($slides as $slide) {

            /** @var \TYPO3\CMS\Core\Resource\File $file */
            $file = $slide->getOriginalFile();

            $item = [
                'thumbnail' => $this->createProcessedThumbnail($file)->getPublicUrl(true),
                'enlarged' => $this->createProcessedEnlarged($file)->getPublicUrl(true),
                'title' => $slide->getProperty('title'),
                'desc' => $slide->getProperty('description'),
                'slideLink' => $slide->getProperty('link'),
                'refProp' => $slide->getProperties(),
                'fileProp' => $file->getProperties()
            ];

            $items[] = $item;
        }

        return json_encode($items);
    }

    /**
     * @param File $file
     * @param $widthFormat
     * @param $heightFormat
     * @return ProcessedFile
     * @internal param Content $slide
     */
    public function createProcessedEnlarged(File $file)
    {
        $configuration = [
            'maxWidth' => $this->getSettings()['enlargedImageMaximumWidth'] ? $this->getSettings()['enlargedImageMaximumWidth'] : 1170,
            'maxHeight' => $this->getSettings()['enlargedImageMaximumHeight'] ? $this->getSettings()['enlargedImageMaximumHeight'] : null,
        ];

        if ($configuration['maxWidth'] || $configuration['maxHeight']) {
            $file = $file->process(ProcessedFile::CONTEXT_IMAGECROPSCALEMASK, $configuration);
        }

        return $file;
    }

    /**
     * Resize image and garantees a minimum size for each dimension
     * @param File $file
     * @return File|ProcessedFile
     */
    public function createProcessedThumbnail(File $file)
    {
        $minSize = 84;

        $width = (int) $file->getProperty('width');
        $height = (int) $file->getProperty('height');
        $ratio = $width / $height;

        if ($width > $height) {
            $configuration = [
                'maxWidth' => ceil($minSize * $ratio),
                'height' => $minSize
            ];
        } else {
            $configuration = [
                'width' => $minSize,
                'maxHeight' => ceil($minSize / $ratio)
            ];
        }

        $file = $file->process(ProcessedFile::CONTEXT_IMAGECROPSCALEMASK, $configuration);

        return $file;
    }

    /**
     * @throws array
     */
    public function getSettings()
    {
        $settings = $this->templateVariableContainer->get('settings');

        return $settings;
    }
}
