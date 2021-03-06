<?php

namespace Kendo\Layout;

/**
 * Class AlertDecorator
 *
 * @package Kendo\Layout
 */
class AlertDecorator implements Decorator
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
            $header = '<div class="alert-header"><div class="panel-header"><span>' . $title . '</span></div></div>';
        }

        return '<div class="alert ' . $params->get('scheme') . ' ' . $block->getCssClassName() . '">' . $header . '<div class="alert-body">' . $block->getContent() . '</div></div>';
    }
}