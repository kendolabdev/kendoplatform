<?php

namespace Platform\Core\Block;

use Kendo\Layout\Block;

/**
 * Class ActionContentBlock
 *
 * @package Core\Block
 */
class ActionContentBlock extends Block
{
    /**
     * @return string
     */
    public function getContent()
    {
        return \App::requester()->getResponse()->getContent();
    }
}