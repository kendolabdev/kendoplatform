<?php

namespace Picaso\Content;

/**
 * Interface UniqueIdGenerator
 *
 * @package Picaso\Content
 */
interface UniqueIdGenerator
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