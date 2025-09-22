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
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $currentContentObject = $this->request->getAttribute('currentContentObject');
        $contentUid = $currentContentObject ? $currentContentObject->data['uid'] : 0;
        
        $elements = $this->fileRepository->findByRelation('tt_content', 'images', $contentUid);

        // Assign template variables
        $this->view->assign('settings', $this->settings);
        $this->view->assign('data', $currentContentObject ? $currentContentObject->data : []);
        $this->view->assign('slides', $elements);
        return $this->htmlResponse();
    }

}
