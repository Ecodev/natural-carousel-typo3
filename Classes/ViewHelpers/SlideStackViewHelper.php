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

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ProcessedFile;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Context\Context;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * View helper
 */
class SlideStackViewHelper extends AbstractViewHelper
{

    public function __construct(private \TYPO3\CMS\Core\Context\Context $context)
    {
    }
    /**
     * @return string
     */
    public function render()
    {
        $slides = $this->templateVariableContainer->get('slides');

        $items = [];
        
        // Check if slides exist and is iterable
        if (empty($slides) || !is_iterable($slides)) {
            return json_encode($items);
        }
        foreach ($slides as $slide) {
            try {
                /** @var \TYPO3\CMS\Core\Resource\File $file */
                $file = $slide->getOriginalFile();

                $baseUrl = GeneralUtility::getIndpEnv('TYPO3_SITE_URL');
                
                $item = [
                    'thumbnail' => $baseUrl . $this->createProcessedThumbnail($file)->getPublicUrl(),
                    'enlarged' => $baseUrl . $this->createProcessedEnlarged($file)->getPublicUrl(),
                    'title' => $slide->getProperty('title'),
                    'desc' => $slide->getProperty('description'),
                    'slideLink' => $slide->getProperty('link'),
                    'refProp' => $slide->getProperties(),
                    'fileProp' => $file->getProperties()
                ];

                $items[] = $item;
            } catch (\Exception $e) {
                continue;
            }
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
        try {
            $settings = $this->getSettings();
            $configuration = [
                'maxWidth' => isset($settings['enlargedImageMaximumWidth']) ? (int)$settings['enlargedImageMaximumWidth'] : 1170,
                'maxHeight' => isset($settings['enlargedImageMaximumHeight']) ? (int)$settings['enlargedImageMaximumHeight'] : null,
            ];

            if ($configuration['maxWidth'] || $configuration['maxHeight']) {
                $file = $file->process(ProcessedFile::CONTEXT_IMAGECROPSCALEMASK, $configuration);
            }

            return $file;
        } catch (\Exception $e) {
            // Return original file if processing fails
            return $file;
        }
    }

    /**
     * Resize image and garantees a minimum size for each dimension
     * @param File $file
     * @return File|ProcessedFile
     */
    public function createProcessedThumbnail(File $file)
    {
        try {
            $minSize = 84;

            $width = (int) $file->getProperty('width');
            $height = (int) $file->getProperty('height');
            
            // Prevent division by zero
            if ($height <= 0) {
                return $file;
            }
            
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
        } catch (\Exception $e) {
            // Return original file if processing fails
            return $file;
        }
    }

    /**
     * @throws array
     */
    public function getSettings()
    {
        $settings = $this->templateVariableContainer->get('settings');

        return $settings;
    }

    /**
     * Get the site URL
     * @return string
     */
    protected function getSiteUrl(): string
    {
        $siteFinder = GeneralUtility::makeInstance(SiteFinder::class);
        
        // Get current page ID from context or fallback to 1
        $context = $this->context;
        $pageId = 1; // Default fallback
        
        try {
            if ($context->hasAspect('frontend.page')) {
                $pageId = $context->getPropertyFromAspect('frontend.page', 'id', 1);
            }
        } catch (\Exception $e) {
            // If context is not available, use default page ID
            $pageId = 1;
        }
        
        try {
            $site = $siteFinder->getSiteByPageId($pageId);
            return (string)$site->getBase();
        } catch (\Exception $e) {
            // If site cannot be found, try to get the first available site
            $sites = $siteFinder->getAllSites();
            if (!empty($sites)) {
                $firstSite = reset($sites);
                return (string)$firstSite->getBase();
            }
            // Ultimate fallback
            return '/';
        }
    }
}
