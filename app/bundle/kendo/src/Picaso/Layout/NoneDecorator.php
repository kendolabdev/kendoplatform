<?php

namespace Picaso\Layout;

/**
 * Class DecoratorNone
 *
 * @package Picaso\Layout
 */
class DecoratorNone implements Decorator
{

    /**
     * @param  Block $block
     * @param  array $params
     *
     * @return string
     */
    public function render(Block $block, $params = [])
    {
        return $block->getContent();
    }

}