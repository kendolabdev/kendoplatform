<?php

namespace Picaso\Layout;

/**
 * Class BlockWrapperDefault
 *
 * @package Picaso\Layout
 */
class BlockWrapperDefault implements BlockWrapper
{

    /**
     * @param  Block $block
     * @param  array $params
     *
     * @return string
     */
    public function render(Block $block, $params = [])
    {
        return '<div class="' . $block->getCssClassName() . '">' . $block->getContent() . '</div>';
    }
}