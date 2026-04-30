<?php

namespace Fab\NaturalCarousel\Controller;

use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CarouselController extends ActionController
{
    protected array $configuration = [];
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
        $contentUid = $currentContentObject ? (int)$currentContentObject->data['uid'] : 0;
        $row = $currentContentObject ? $currentContentObject->data : [];

        $elements = $this->fileRepository->findByRelation('tt_content', 'images', $contentUid);
        if ($elements === []) {
            $elements = $this->fileRepository->findByRelation('tt_content', 'settings.images', $contentUid);
        }
        if ($elements === [] && !empty($row['pi_flexform'])) {
            $elements = $this->resolveSlidesFromSavedFlexForm($row['pi_flexform']);
        }

        $this->view->assignMultiple([
            'settings' => $this->settings,
            'data' => $row,
            'slides' => $elements,
        ]);

        return $this->htmlResponse();
    }

    /**
     * When pi_flexform stores a comma list of sys_file_reference uids (file field), load them
     * even if findByRelation misses (e.g. legacy fieldname). Ignores unresolved "NEW..." tokens.
     *
     * @return list<\TYPO3\CMS\Core\Resource\FileReference>
     */
    private function resolveSlidesFromSavedFlexForm(string $flexFormContent): array
    {
        $service = GeneralUtility::makeInstance(FlexFormService::class);
        $sheets = $service->convertFlexFormContentToSheetsArray($flexFormContent);
        $selection = $sheets['selection'] ?? [];
        if (!is_array($selection)) {
            return [];
        }
        $raw = null;
        foreach (['images', 'settings.images'] as $key) {
            if (isset($selection[$key]) && is_string($selection[$key]) && $selection[$key] !== '') {
                $raw = $selection[$key];
                break;
            }
        }
        if ($raw === null || preg_match('/NEW/i', $raw)) {
            return [];
        }
        $uids = [];
        foreach (GeneralUtility::trimExplode(',', $raw, true) as $part) {
            if (MathUtility::canBeInterpretedAsInteger($part)) {
                $uids[] = (int)$part;
            }
        }
        if ($uids === []) {
            return [];
        }
        $factory = GeneralUtility::makeInstance(ResourceFactory::class);
        $out = [];
        foreach ($uids as $uid) {
            try {
                $out[] = $factory->getFileReferenceObject($uid);
            } catch (ResourceDoesNotExistException) {
            }
        }

        return $out;
    }
}
