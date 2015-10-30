<?php
namespace Picaso\Navigation;

/**
 * Interface NavigationLoaderInterface
 *
 * @package Picaso\Navigation
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