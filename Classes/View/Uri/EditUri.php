<?php

namespace Fab\NaturalCarousel\View\Uri;

/*
 * This file is part of the Fab/NaturalCarousel project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use Fab\NaturalCarousel\View\AbstractComponentView;
use Fab\NaturalCarousel\Domain\Model\Content;
use Fab\NaturalCarousel\Utility\BackendUtility;

/**
 * View which renders a "edit" button to be placed in the grid.
 */
class EditUri extends AbstractComponentView
{
    /**
     * Renders a "edit" button to be placed in the grid.
     *
     * @param Content $object
     * @return string
     */
    public function render(Content $object = null)
    {
        $uri = BackendUtility::getModuleUrl(
            'record_edit',
            array(
                $this->getEditParameterName($object) => 'edit',
                'returnUrl' => $this->getModuleLoader()->getModuleUrl()
            )
        );
        return $uri;
    }

    /**
     * @param Content $object
     * @return string
     */
    protected function getEditParameterName(Content $object)
    {
        return sprintf(
            'edit[%s][%s]',
            $object->getDataType(),
            $object->getUid()
        );
    }
}
