<?php
namespace Picaso\Layout;

/**
 * Interface LayoutLoaderInterface
 *
 * @package Picaso\Layout
 */
interface LayoutLoaderInterface
{
    /**
     * @param string $pageName
     * @param string $templateId
     * @param string $screenSize
     *
     * @return array
     */
    public function loadDataForRender($pageName, $templateId, $screenSize);
}