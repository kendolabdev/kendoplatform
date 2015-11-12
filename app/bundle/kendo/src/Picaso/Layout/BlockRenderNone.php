<?php

namespace Picaso\Layout;

/**
 * Class BlockWrapperNone
 *
 * @package Picaso\Layout
 */
class BlockRenderNone implements BlockRender
{

    /**
     * @param  Block $block
     * @param  array $params
     *
     * @return string
     */
    public function render(Block $block, $params = [])
    {
        return $block->getContent();
    }

}