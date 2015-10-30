<?php

namespace Core\Block;

use Picaso\Layout\Block;

/**
 * Class CustomHtmlBlock
 *
 * @package Core\Block
 */
class CustomHtmlBlock extends Block
{

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->lp->get('title', '');
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->lp->get('content', '');
    }
}