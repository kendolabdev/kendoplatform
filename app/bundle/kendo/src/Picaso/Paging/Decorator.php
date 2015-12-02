<?php

namespace Picaso\Paging;

/**
 * Interface Decorator
 *
 * @package Picaso\Paging
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