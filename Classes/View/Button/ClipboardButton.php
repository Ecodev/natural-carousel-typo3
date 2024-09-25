<?php

namespace Fab\NaturalCarousel\View\Button;

/*
 * This file is part of the Fab/NaturalCarousel project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */
use Fab\NaturalCarousel\Service\ClipboardService;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Fab\NaturalCarousel\View\AbstractComponentView;

/**
 * View which renders a "clipboard" button to be placed in the doc header.
 */
class ClipboardButton extends AbstractComponentView
{
    /**
     * Renders a "clipboard" button to be placed in the doc header.
     *
     * @return string
     */
    public function render()
    {
        $button = $this->makeLinkButton()
            ->setHref($this->getShowClipboardUri())
            ->setDataAttributes([
                'style' => $this->getClipboardService()->hasItems() ? '' : 'display: none;',
            ])
            ->setClasses('btn-clipboard-copy-or-move')
            ->setTitle($this->getLanguageService()->sL('LLL:EXT:natural-carousel-typo3/Resources/Private/Language/locallang.xlf:clipboard.copy_or_move'))
            ->setIcon($this->getIconFactory()->getIcon('actions-document-paste-after', Icon::SIZE_SMALL))
            ->render();

        // Hack! No API for adding a style upon a button
        $button = str_replace('data-style', 'style', $button);

        $output = sprintf('<div style="float: left; margin-right: 3px">%s</div>', $button);
        return $output;
    }

    /**
     * @return string
     */
    protected function getShowClipboardUri()
    {
        $additionalParameters = array(
            $this->getModuleLoader()->getParameterPrefix() => array(
                'controller' => 'Clipboard',
                'action' => 'show',
            ),
        );
        return $this->getModuleLoader()->getModuleUrl($additionalParameters);
    }

    /**
     * Get the NaturalCarousel Module Loader.
     *
     * @return ClipboardService|object
     */
    protected function getClipboardService()
    {
        return GeneralUtility::makeInstance(ClipboardService::class);
    }
}
