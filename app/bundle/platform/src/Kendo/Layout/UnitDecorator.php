<?php

namespace Kendo\Layout;

/**
 * Class UnitDecorator
 *
 * @package Kendo\Layout
 */
class UnitDecorator implements Decorator
{
    /**
     * @param BlockController $block
     * @param DecoratorParams $params
     *
     * @return mixed
     */
    public function render(BlockController $block, DecoratorParams $params)
    {
        $title = $block->getTitle();
        $header = '';
        if ($title) {
            $header = '<div class="unit-header"><div class="unit-title"><span>' . $title . '</span></div></div>';
        }

        return '<div class="unit ' . $block->getCssClassName() . '">' . $header . '<div class="unit-content">' . $block->getContent() . '</div></div>';
    }
}