<?php

namespace Kendo\Paging;

/**
 * Interface Decorator
 *
 * @package Kendo\Paging
 */
interface Decorator
{

    /**
     * Render paging to html code
     *
     * @return string
     */
    public function render();
}