<?php
namespace Picaso\Content;

/**
 * Interface CanComment
 *
 * @package Picaso\Content
 */
interface CanComment
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return mixed
     */
    public function getCommentCount();

    /**
     * @param $value
     *
     */
    public function setCommentCount($value);

    /**
     * @param $column
     * @param $value
     */
    public function modify($column, $value);

}