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
     * @param BlockController $block
     * @param DecoratorParams $params
     *
     * @return string
     */
    public function render(BlockController $block, DecoratorParams $params)
    {
        return $block->getContent();
    }
}