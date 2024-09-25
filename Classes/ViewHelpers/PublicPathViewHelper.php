<?php

namespace Fab\NaturalCarousel\ViewHelpers;

/*
 * This file is part of the Fab/NaturalCarousel project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */
use Fab\NaturalCarousel\Utility\ExtensionManagementUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Return the public path to NaturalCarousel extension.
 */
class PublicPathViewHelper extends AbstractViewHelper
{
    /**
     * Returns the public path to Vidi extension.
     *
     * @return string
     */
    public function render()
    {
        return ExtensionManagementUtility::siteRelPath('vidi');
    }
}
