<?php
namespace Core\Block;

use Picaso\Layout\Block;

/**
 * Class AdminInfoBlock
 *
 * @package Core\Block
 */
class AdminInfoBlock extends Block
{

    /**
     * @var string
     */
    protected $basePath = 'base/core/block/admin-info';

    /**
     *
     */
    public function execute()
    {
        $this->view->assign([
            'date'    => date('Y-m-d H:i:s'),
            'license' => 'AAAA-BBBB-CCCC-DDD',
            'version' => '4.0.0',
        ]);
    }
}