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
     * @param Block $block
     * @param DecoratorParams $params
     * @return string
     */
    public function render(Block $block, DecoratorParams $params)
    {
        return $block->getContent();
    }
}