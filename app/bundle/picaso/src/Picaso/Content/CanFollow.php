<?php
namespace Picaso\Content;

/**
 * Interface CanFollow
 *
 * @package Picaso\Content
 */
interface CanFollow
{

    /**
     * @return int
     */
    public function getFollowCount();

    /**
     * @param $column
     * @param $value
     */
    public function modify($column, $value);
}