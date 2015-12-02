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
     * @param Block $block
     * @param DecoratorParams $params
     * @return mixed
     */
    public function render(Block $block, DecoratorParams $params);
}