<?php
namespace Kendo\Content;

/**
 * Interface AtomInterface
 *
 * @package Kendo\Content
 */
interface AtomInterface extends UniqueId
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return PosterInterface
     */
    public function getParent();

    /**
     * @param $column
     * @param $value
     */
    public function modify($column, $value);
}