<?php
namespace Picaso\Content;

/**
 * Interface CanLike
 *
 * @package Picaso\Content
 */
interface CanLike
{
    /**
     * @return int
     */
    public function getLikeCount();

    /**
     * @param int $value
     */
    public function setLikeCount($value);

    /**
     * @param $column
     * @param $value
     */
    public function modify($column, $value);

}