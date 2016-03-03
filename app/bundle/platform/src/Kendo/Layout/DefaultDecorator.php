<?php

namespace Kendo\Layout;

/**
 * Class DefaultDecorator
 *
 * @package Kendo\Layout
 */
class DefaultDecorator implements Decorator
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
            $header = '<div class="block-header"><div class="block-title"><span>' . $title . '</span></div></div>';
        }

        return '<div class="block ' . $params->get('scheme') . ' ' . $block->getCssClassName() . '">' . $header . '<div class="block-body">' . $block->getContent() . '</div></div>';
    }
}