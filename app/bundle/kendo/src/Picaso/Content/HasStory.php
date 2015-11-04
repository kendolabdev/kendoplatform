<?php
namespace Picaso\Content;

/**
 * Interface HasStory
 *
 * @package Picaso\Content
 */
interface HasStory
{

    /**
     * @param string $value
     */
    public function setStory($value);

    /**
     * @return string
     */
    public function getStory();

}

