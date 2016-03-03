<?php
namespace Platform\Core\Block;

use Kendo\Layout\BlockController;

/**
 * Class AdminStatisticBlock
 *
 * @package Core\Block
 */
class AdminStatisticBlock extends BlockController
{

    /**
     * @var string
     */
    protected $basePath = 'platform/core/block/admin-statistic';

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Statistic';
    }

    /**
     *
     */
    public function execute()
    {

        $this->view->assign(['stats' => []]);

        \App::emitter()
            ->emit('onAdminStatisticBlockRender', $this->view);

    }
}