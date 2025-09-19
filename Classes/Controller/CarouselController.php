<?php

namespace Fab\NaturalCarousel\Controller;

use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CarouselController extends ActionController
{
    protected array $configuration = array();
    protected $settings = array();
    protected FileRepository $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @return void
     */
    public function listAction()
    {
        $elements = $this->fileRepository->findByRelation('tt_content', 'images', $this->configurationManager->getcontentObject()->data['uid']);

        // Assign template variables
        $this->view->assign('settings', $this->settings);
        $this->view->assign('data', $this->configurationManager->getcontentObject()->data);
        $this->view->assign('slides', $elements);
    }

}
