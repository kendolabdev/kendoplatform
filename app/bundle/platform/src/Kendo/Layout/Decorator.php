<?php

namespace Kendo\Layout;

/**
 * Interface BlockWrapper
 *
 * @package Kendo\Layout
 */
interface Decorator
{

    /**
     * @param Block           $block
     * @param DecoratorParams $params
     *
     * @return mixed
     */
    public function render(Block $block, DecoratorParams $params);
}