<?php

namespace Fab\NaturalCarousel\Controller;

use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CarouselController extends ActionController
{
    protected array $configuration = array();
    protected $settings = array();
    protected ?FileRepository $fileRepository = null;

    public function __construct()
    {
        $this->fileRepository = GeneralUtility::makeInstance(FileRepository::class);
    }

    /**
     * @return void
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $currentContentObject = $this->request->getAttribute('currentContentObject');
        $contentUid = $currentContentObject ? $currentContentObject->data['uid'] : 0;
        
        $elements = $this->fileRepository->findByRelation('tt_content', 'images', $contentUid);
        $this->view->assignMultiple([
            'settings' => $this->settings,
            'data' => $currentContentObject ? $currentContentObject->data : [],
            'slides' => $elements
        ]);
        
        return $this->htmlResponse();
    }

}
