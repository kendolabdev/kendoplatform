<?php
namespace Kendo\Navigation;

/**
 * Interface NavigationLoaderInterface
 *
 * @package Kendo\Navigation
 */
interface NavigationLoaderInterface
{
    /**
     * @param string $navigationId
     * @param string $parentId
     *
     * @return array
     */
    public function load($navigationId, $parentId);
}