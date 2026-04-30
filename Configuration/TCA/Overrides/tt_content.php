<?php

declare(strict_types=1);

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

/**
 * Plugin TCA must load from Configuration/TCA/Overrides (TYPO3 v12+).
 * Registering pi_flexform in ext_tables.php is deprecated and can break flex / FAL persistence.
 */
(static function (): void {
    ExtensionUtility::registerPlugin(
        'natural_carousel',
        'Pi1',
        'LLL:EXT:natural_carousel/Resources/Private/Language/locallang.xlf:wizard.title',
        'content-natural-carousel',
        'plugins',
        'LLL:EXT:natural_carousel/Resources/Private/Language/locallang.xlf:wizard.description',
    );

    $extensionName = GeneralUtility::underscoredToUpperCamelCase('natural_carousel');
    $pluginSignature = strtolower($extensionName) . '_pi1';

    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature]
        = 'layout,recursive,select_key,pages';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

    ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature,
        'FILE:EXT:natural_carousel/Configuration/FlexForm/NaturalCarousel.xml',
    );
})();
