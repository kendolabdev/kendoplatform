<?php
namespace Picaso\Content;

/**
 * Interface CanShare
 *
 * @package Picaso\Content
 */
interface CanShare
{
    /**
     * @return int
     */
    public function getShareCount();

    /**
     * @param int $value
     */
    public function setShareCount($value);

    /**
     * @param $column
     * @param $value
     */
    public function modify($column, $value);
}