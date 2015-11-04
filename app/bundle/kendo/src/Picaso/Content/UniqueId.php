<?php
namespace Picaso\Content;

/**
 * Implement this interface to mark that your content has global unique id.
 *
 * Interface UniqueId
 *
 * @package Picaso\Content
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