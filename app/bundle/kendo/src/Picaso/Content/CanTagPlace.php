<?php
namespace Picaso\Content;

/**
 * Interface CanTagPlace
 *
 * @package Picaso\Content
 */
interface CanTagPlace
{
    /**
     * @return int
     */
    public function getPlaceId();

    /**
     * @return string
     */
    public function getPlaceType();

    /**
     * @param string $value
     */
    public function setPlaceType($value);

    /**
     * @param int $value
     */
    public function setPlaceId($value);

    /**
     * @return Content
     */
    public function getPlace();

    /**
     * @param $value
     */
    public function setPlace($value);
}