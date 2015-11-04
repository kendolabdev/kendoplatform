<?php

namespace Picaso\Layout;

/**
 * Class BlockWrapperNone
 *
 * @package Picaso\Layout
 */
class BlockWrapperNone implements BlockWrapper
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
            $header = '<div class="block-header"><div class="block-title"><span>' . $title . '</span></div></div>';
        }

        return '<div class="' . $block->getCssClassName() . '">' . $header . '<div class="block-content">' . $block->getContent() . '</div></div>';
    }

}