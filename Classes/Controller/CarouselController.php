<?php

namespace Fab\NaturalCarousel\Controller;

use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CarouselController extends ActionController
{

    protected array $configuration = array();

    protected $settings = array();

    /**
     * @return void
     */
    public function listAction()
    {

        $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
        $elements = $fileRepository->findByRelation('tt_content', 'images', $this->configurationManager->getcontentObject()->data['uid']);

        // Assign template variables
        $this->view->assign('settings', $this->settings);
        $this->view->assign('data', $this->configurationManager->getcontentObject()->data);
        $this->view->assign('slides', $elements);

    }

}
