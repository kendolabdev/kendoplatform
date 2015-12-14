<?php

namespace Kendo\Kernel;

/**
 * Interface UniqueIdGenerator
 *
 * @package Kendo\Content
 */
interface UniqueIdGeneratorInterface
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