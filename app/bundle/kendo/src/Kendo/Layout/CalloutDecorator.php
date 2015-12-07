<?php

namespace Kendo\Layout;

/**
 * Class CalloutDecorator
 * @package Kendo\Layout
 */
class CalloutDecorator implements Decorator
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
            $header = '<div class="panel-header"><div class="panel-header"><span>' . $title . '</span></div></div>';
        }

        return '<div class="panel ' . $params->get('scheme') . ' ' . $block->getCssClassName() . '">' . $header . '<div class="panel-body">' . $block->getContent() . '</div></div>';
    }
}