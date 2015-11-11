<?php

namespace Core\Block;

use Picaso\Layout\Block;

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
    public function getWrapper()
    {
        return 'none';
    }


    /**
     * @return string
     */
    public function getContent()
    {
        return \App::request()->getInitiator()->getResponse();
    }
}