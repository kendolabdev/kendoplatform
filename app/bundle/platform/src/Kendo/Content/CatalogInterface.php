<?php

namespace Kendo\Content;

/**
 * Interface HasAttribute
 *
 * @package Kendo\Content
 */
interface CatalogInterface
{
    /**
     * @return int
     */
    public function getCatalogId();

    /**
     * @param string $dataType
     *
     * @return \Kendo\Db\DbTable
     */
    public function getAttributeValueTable($dataType = null);
}