<?php
namespace Fab\NaturalCarousel\Utility;

/**
 * This file is part of the TYPO3 CMS project.
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Utility class to manage partial loading registry
 */
class PartialLoadingRegister
{

    protected static $registry = [];

 
    public function __construct()
    {
    }

    public function register(string $name): void
    {
        self::$registry[$name] = true;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function usePartial(string $name): bool
    {
        $isUsed = isset(self::$registry[$name]);
        $this->register($name);

        return $isUsed;
    }

}
