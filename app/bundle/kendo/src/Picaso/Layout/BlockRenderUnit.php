<?php

namespace Picaso\Layout;

/**
 * Class BlockRenderUnit
 *
 * @package Picaso\Layout
 */
class BlockRenderUnit implements BlockRender
{
    /**
     * @param  Block $block
     * @param  array $params
     *
     * @return string
     */
    public function render(Block $block, $params = [])
    {
        $title = $block->getTitle();
        $header = '';
        if ($title) {
            $header = '<div class="unit-header"><div class="unit-title"><span>' . $title . '</span></div></div>';
        }

        return '<div class="_unit ' . $block->getCssClassName() . '">' . $header . '<div class="unit-content">' . $block->getContent() . '</div></div>';
    }
}