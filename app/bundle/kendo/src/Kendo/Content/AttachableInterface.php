<?php

namespace Kendo\Content;

/**
 * Interface Attachable
 *
 * @package Kendo\Content
 */
interface AttachableInterface
{
    /**
     * @param array $params
     *
     * @return string
     */
    public function toHtml($params = []);
}