<?php

namespace Kendo\Layout;

/**
 * Class WidgetDecorator
 * @package Kendo\Layout
 */
class WidgetDecorator implements Decorator
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
            $header = '<div class="widget-header"><div class="widget-title"><span>' . $title . '</span></div></div>';
        }

        return '<div class="widget ' . $params->get('scheme') . ' ' . $block->getCssClassName() . '">' . $header . '<div class="widget-body">' . $block->getContent() . '</div></div>';
    }
}