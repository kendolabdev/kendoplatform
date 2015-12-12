<?php
namespace Platform\Core\Block;

use Kendo\Layout\Block;

/**
 * Class AdminUpdateBlock
 *
 * @package Core\Block
 */
class AdminUpdateBlock extends Block
{
    /**
     * @var string
     */
    protected $basePath = 'platform/core/block/admin-update';

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Recent News';
    }

    /**
     *
     */
    public function execute()
    {
    }
}