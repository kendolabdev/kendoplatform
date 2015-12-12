<?php
namespace Kendo\Layout;

/**
 * Interface LayoutLoaderInterface
 *
 * @package Kendo\Layout
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