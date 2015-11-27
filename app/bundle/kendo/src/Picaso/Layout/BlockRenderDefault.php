<?php

namespace Picaso\Layout;

/**
 * Class BlockWrapperDefault
 *
 * @package Picaso\Layout
 */
class BlockRenderDefault implements BlockRender
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
            $header = '<div class="_block-header"><div class="_block-title"><span>' . $title . '</span></div></div>';
        }

        return '<div class="_block ' . $block->getCssClassName() . '">' . $header . '<div class="_block-body">' . $block->getContent() . '</div></div>';
    }
}