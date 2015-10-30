<?php
namespace Picaso\Content;


/**
 * Interface HasCover
 *
 * @package Picaso\Content
 */
interface HasCover
{
    /**
     * @return int
     */
    public function getId();


    /**
     * @return string
     */
    public function getType();
}