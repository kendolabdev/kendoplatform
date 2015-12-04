<?php

namespace Picaso\Layout;

/**
 * Class DefaultDecorator
 * @package Picaso\Layout
 */
class DefaultDecorator implements Decorator
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
        if ($title)
        {
            $header = '<div class="block-header"><div class="block-title"><span>' . $title . '</span></div></div>';
        }

        return '<div class="block ' . $params->get('scheme') . ' ' . $block->getCssClassName() . '">' . $header . '<div class="block-body">' . $block->getContent() . '</div></div>';
    }
}