<?php

use Fab\NaturalCarousel\Controller\CarouselController;

defined('TYPO3_MODE') or die();

call_user_func(
    function () {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Fab.natural_carousel',
            'Pi1',
            [
                CarouselController::class => 'list',
            ],
            // non-cachable actions
            []
        );

        // Register icons
        $icons = [
            'content-natural-carousel' => 'EXT:natural_carousel/ext_icon.png',
        ];
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        foreach ($icons as $identifier => $path) {
            $iconRegistry->registerIcon(
                $identifier, TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class, ['source' => $path]
            );
        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        tx_naturalcarousel_templatebasedcontent {
                            iconIdentifier = content-natural-carousel
                            title = LLL:EXT:natural_carousel/Resources/Private/Language/locallang.xlf:wizard.title
                            description = LLL:EXT:natural_carousel/Resources/Private/Language/locallang.xlf:wizard.description
                            tt_content_defValues {
                                CType = list
                                list_type = naturalcarousel_pi1
                            }
                        }
                    }
                }
            }'
        );
    }
);
