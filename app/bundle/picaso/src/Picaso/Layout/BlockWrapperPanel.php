<?php

namespace Picaso\Layout;

use Picaso\View\View;

/**
 * Class BlockWrapperPanel
 *
 * @package Picaso\Layout
 */
class BlockWrapperPanel implements BlockWrapper
{
    /**
     * @param  Block $block
     * @param  array $params
     *
     * @return string
     */
    public function render(Block $block, $params = [])
    {
        return (new View('/layout/block/block-wrapper-panel', [
            'block'  => $block,
            'params' => $params
        ]))->render();
    }

}