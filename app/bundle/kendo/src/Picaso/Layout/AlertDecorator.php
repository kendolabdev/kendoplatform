<?php

namespace Picaso\Layout;

/**
 * Class AlertDecorator
 * @package Picaso\Layout
 */
class AlertDecorator implements Decorator
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
            $header = '<div class="alert-header"><div class="panel-header"><span>' . $title . '</span></div></div>';
        }

        return '<div class="alert ' . $params->get('scheme') . ' ' . $block->getCssClassName() . '">' . $header . '<div class="alert-body">' . $block->getContent() . '</div></div>';
    }
}