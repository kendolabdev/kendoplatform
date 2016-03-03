<?php

namespace Platform\Core\Block;

use Kendo\Layout\BlockController;

/**
 * Class CustomHtmlBlock
 *
 * @package Core\Block
 */
class CustomHtmlBlock extends BlockController
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