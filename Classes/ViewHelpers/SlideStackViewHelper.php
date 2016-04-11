<?php
namespace Fab\AgileCarousel\ViewHelpers;

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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

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
        foreach ($slides as $slide) {

            /** @var \TYPO3\CMS\Core\Resource\File $file */
//            $file = ResourceFactory::getInstance()->getFileObject($slide->getUid());
//            $thumbnailFile = $this->createProcessedFile($file, 'thumbnailMaximumWidth', 'thumbnailMaximumHeight');
//            $enlargedFile = $this->createProcessedFile($file, 'enlargedImageMaximumWidth', 'enlargedImageMaximumHeight');

            //            $item = [
            //                'thumbnail' => '/' . $thumbnailFile->getPublicUrl(true),
            //                'enlarged' => '/' . $enlargedFile->getPublicUrl(true),
            //                'uid' => $file->getProperty('uid'),
            //                'title' => $file->getProperty('title'),
            //                'description' => $file->getProperty('description'),
            //                'slideLink' => $file->getProperty('slideLink'),
            //                'buttonLabel' => $file->getProperty('buttonLabel'),
            //                'buttonLink' => $file->getProperty('buttonLink')
            //            ];

            $item = [
                'thumbnail' => "https://images.unsplash.com/photo-1459860263946-7966560ccaed?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&w=200&fit=max&s=08aed4f47fa91831e0cf9f72c574acc7",
                'enlarged' => "https://images.unsplash.com/photo-1459860263946-7966560ccaed?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&w=1080&fit=max&s=baa81debe972e9efe3250efd7b7a0f58",
                'title' => 'Title',
                'desc' => 'Maecenas sed diam eget risus varius blandit sit amet non magna. <a href="asdf">Duis mollis</a>, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
                'slideLink' => 'https => //ecodev.ch',
                'buttonLabel' => 'Google',
                'buttonLink' => 'https => //google.ch'
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
    public function createProcessedFile(File $file, $widthFormat, $heightFormat)
    {
        $configuration = [
            'maxWidth' => $this->getSettings()[$widthFormat] ? $this->getSettings()[$widthFormat] : null,
            'maxHeight' => $this->getSettings()[$heightFormat] ? $this->getSettings()[$heightFormat] : null,
        ];

        if ($configuration['maxWidth'] || $configuration['maxHeight']) {
            $file = $file->process(ProcessedFile::CONTEXT_IMAGECROPSCALEMASK, $configuration);
        }

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
