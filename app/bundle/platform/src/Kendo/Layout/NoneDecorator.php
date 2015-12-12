<?php

namespace Kendo\Layout;

/**
 * Class NoneDecorator
 *
 * @package Kendo\Layout
 */
class NoneDecorator implements Decorator
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