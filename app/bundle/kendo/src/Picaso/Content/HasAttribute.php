<?php

namespace Picaso\Content;

/**
 * Interface HasAttribute
 *
 * @package Picaso\Content
 */
interface HasAttribute
{
    /**
     * @return int
     */
    public function getCatalogId();

    /**
     * @param string $dataType
     *
     * @return \Picaso\Db\DbTable
     */
    public function getAttributeValueTable($dataType = null);
}