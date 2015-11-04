<?php
namespace Picaso\Content;

/**
 * Interface HasPhoto
 *
 * @package Picaso\Content
 */
interface HasPhoto
{
    /**
     * @return int
     */
    public function getPhotoFileId();

    /**
     * @param string $value
     */
    public function setPhotoFileId($value);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $maker
     *
     * @return string
     */
    public function getPhoto($maker);
}