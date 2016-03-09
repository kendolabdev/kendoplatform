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
        return app()->requester()->getResponse()->getContent();;
    }
}