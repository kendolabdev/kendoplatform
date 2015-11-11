<?php
namespace Core\Block;

use Picaso\Layout\Block;

/**
 * Class AdminStatisticBlock
 *
 * @package Core\Block
 */
class AdminStatisticBlock extends Block
{

    /**
     * @var string
     */
    protected $basePath = 'base/core/block/admin-statistic';

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

        \App::hook()
            ->notify('onAdminStatisticBlockRender', $this->view);

    }
}