<?php
namespace Fab\NaturalCarousel\Controller;

/**
 * This file is part of the TYPO3 CMS project.
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;


/**
 * Controller
 */
class CarouselController extends ActionController
{

    /**
     * @var array
     */
    protected $configuration = array();

    /**
     * @var array
     */
    protected $settings = array();

    /**
     * @return void
     */
    public function listAction()
    {

        $fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(FileRepository::class);
        $elements = $fileRepository->findByRelation('tt_content', 'images', $this->configurationManager->getcontentObject()->data['uid']);

        // Assign template variables
        $this->view->assign('settings', $this->settings);
        $this->view->assign('data', $this->configurationManager->getcontentObject()->data);
        $this->view->assign('slides', $elements);

    }

}
