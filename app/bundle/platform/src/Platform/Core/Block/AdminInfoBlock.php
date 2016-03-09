<?php
namespace Platform\Core\Block;

use Kendo\Layout\BlockController;

/**
 * Class AdminInfoBlock
 *
 * @package Core\Block
 */
class AdminInfoBlock extends BlockController
{

    /**
     * @var string
     */
    protected $basePath = 'platform/core/block/admin-info';

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'License Information';
    }

    /**
     *
     */
    public function execute()
    {
        $license = app()->setting('license');

        $this->view->assign([
            'date'    => date('Y-m-d H:i:s'),
            'license' => $license,
            'version' => app()->version(),
        ]);
    }
}