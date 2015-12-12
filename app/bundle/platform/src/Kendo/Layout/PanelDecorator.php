<?php

namespace Kendo\Layout;

/**
 * Class PanelDecorator
 *
 * @package Kendo\Layout
 */
class PanelDecorator implements Decorator
{
    /**
     * @param Block           $block
     * @param DecoratorParams $params
     *
     * @return mixed
     */
    public function render(Block $block, DecoratorParams $params)
    {
        $title = $block->getTitle();
        $header = '';
        if ($title) {
            $header = '<div class="panel-header"><div class="panel-title"><span>' . $title . '</span></div></div>';
        }

        return '<div class="panel ' . $params->get('scheme') . ' ' . $block->getCssClassName() . '">' . $header . '<div class="panel-body">' . $block->getContent() . '</div></div>';
    }
}