<?php

namespace Picaso\Content;

/**
 * Interface Attachable
 *
 * @package Picaso\Content
 */
interface Attachable
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
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = []);
}