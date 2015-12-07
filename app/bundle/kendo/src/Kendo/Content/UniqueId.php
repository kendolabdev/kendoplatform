<?php
namespace Kendo\Content;

/**
 * Implement this interface to mark that your content has global unique id.
 *
 * Interface UniqueId
 *
 * @package Kendo\Content
 */
interface UniqueId
{

    /**
     * Get global Id
     *
     * @return int
     */
    public function getId();

    /**
     * Set global ID
     *
     * @param int $value
     */
    public function setId($value);
}