<?php

namespace Picaso\Layout;

/**
 * Class UnitDecorator
 *
 * @package Picaso\Layout
 */
class UnitDecorator implements Decorator
{
    /**
     * @param Block $block
     * @param DecoratorParams $params
     * @return mixed
     */
    public function render(Block $block, DecoratorParams $params)
    {
        $title = $block->getTitle();
        $header = '';
        if ($title) {
            $header = '<div class="unit-header"><div class="unit-title"><span>' . $title . '</span></div></div>';
        }

        return '<div class="_unit ' . $block->getCssClassName() . '">' . $header . '<div class="unit-content">' . $block->getContent() . '</div></div>';
    }
}