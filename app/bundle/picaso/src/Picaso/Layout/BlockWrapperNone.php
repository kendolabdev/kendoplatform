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

        return '<div class="' . $block->getCssClassName() . '">' . $block->getContent() . '</div>';
    }

}