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
    public function getDecorator()
    {
        return 'unit';
    }


    /**
     * @return string
     */
    public function getContent()
    {
        return \App::requestService()->getInitiator()->getResponse();
    }
}