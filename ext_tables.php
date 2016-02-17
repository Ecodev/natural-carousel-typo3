<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Fab.agile_carousel',
    'Pi1',
    'Agile Carousel'
);

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('agile_carousel');
$pluginSignature = strtolower($extensionName) . '_pi1';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:agile_carousel/Configuration/FlexForm/AgileCarousel.xml');

if (TYPO3_MODE == "BE") {
	$TBE_MODULES_EXT["xMOD_db_new_content_el"]['addElClasses']['tx_agilecarousel_wizard'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('agile_carousel') . 'Classes/Backend/Wizard.php';
}