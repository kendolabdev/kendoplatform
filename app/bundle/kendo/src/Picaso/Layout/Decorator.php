<?php

namespace Picaso\Layout;

/**
 * Interface BlockWrapper
 *
 * @package Picaso\Layout
 */
interface Decorator
{

    /**
     * @param  Block $block
     * @param  array $params
     *
     * @return string
     */
    public function render(Block $block, $params = []);
}