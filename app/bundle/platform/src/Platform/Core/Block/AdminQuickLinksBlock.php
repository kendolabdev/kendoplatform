<?php
namespace Platform\Core\Block;

use Kendo\Layout\BlockController;

/**
 * Class AdminQuickLinksBlock
 *
 * @package Core\Block
 */
class AdminQuickLinksBlock extends BlockController
{

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Quick Links';
    }
}