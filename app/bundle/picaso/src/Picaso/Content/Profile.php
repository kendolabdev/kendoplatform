<?php

namespace Picaso\Content;

/**
 * Interface Profile
 *
 * @package Picaso\Content
 */
interface Profile
{

    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getType();
}