<?php
namespace Core\Block;

use Picaso\Layout\Block;

/**
 * Class AdminStackedTabBlock
 *
 * @package Core\Block
 */
class AdminStackedTabBlock extends Block
{
    /**
     * @var string
     */
    protected $basePath = 'base/core/block/admin-stacked-tab';

    /**
     *
     */
    public function execute()
    {

        $nav = \App::layout()
            ->getSecondaryNavigation();

        if (!$nav->getNav()) {
            $this->setNoRender(true);
        } else {
            $this->view->assign([
                'nav'      => $nav->getNav(),
                'parentId' => $nav->getParentId(),
                'active'   => $nav->getActive(),
            ]);
        }
    }
}