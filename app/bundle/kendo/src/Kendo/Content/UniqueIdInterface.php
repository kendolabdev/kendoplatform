<?php

namespace Kendo\Content;

/**
 * Interface UniqueIdGenerator
 *
 * @package Kendo\Content
 */
interface UniqueIdInterface
{

    /**
     * @return int
     */
    public function nextId();

    /**
     * @param int $value
     */
    public function setNextId($value);
}