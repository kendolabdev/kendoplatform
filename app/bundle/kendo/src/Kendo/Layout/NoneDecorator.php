<?php

namespace Kendo\Layout;

/**
 * Class DecoratorNone
 *
 * @package Kendo\Layout
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