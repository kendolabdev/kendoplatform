<?php

namespace Picaso\Paging;

/**
 * Interface RenderInterface
 *
 * @package Picaso\Paging
 */
interface RenderInterface
{

    /**
     * Render paging to html code
     *
     * @return string
     */
    public function render();
}