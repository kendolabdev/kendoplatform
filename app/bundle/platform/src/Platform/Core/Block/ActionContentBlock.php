<?php

namespace Platform\Core\Block;

use Kendo\Layout\BlockController;

/**
 * Class ActionContentBlock
 *
 * @package Core\Block
 */
class ActionContentBlock extends BlockController
{
    /**
     * @return string
     */
    public function getContent()
    {
        return \App::requester()->getResponse()->getContent();;
    }
}