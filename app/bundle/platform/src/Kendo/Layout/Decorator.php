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
     * @param BlockController $block
     * @param DecoratorParams $params
     *
     * @return mixed
     */
    public function render(BlockController $block, DecoratorParams $params);
}