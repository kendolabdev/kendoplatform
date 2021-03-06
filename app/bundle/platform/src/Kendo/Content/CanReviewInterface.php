<?php

namespace Kendo\Content;

/**
 * Interface CanReviewInterface
 *
 * @package Kendo\Content
 */
interface CanReviewInterface
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
     * @return int
     */
    public function getReviewCount();

    /**
     * @param int $value
     */
    public function setReviewCount($value);

    /**
     * @return number
     */
    public function getReviewValue();

    /**
     * @param number $value
     */
    public function setReviewValue($value);
}