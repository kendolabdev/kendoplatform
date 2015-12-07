<?php
namespace Core\Block;

use Kendo\Layout\Block;

/**
 * Class AdminAsideMenu
 *
 * @package Core\Block
 */
class AdminAsideMenuBlock extends Block
{
    /**
     * @var string
     */
    protected $basePath = 'base/core/block/admin-aside-menu';

    /**
     *
     */
    public function execute()
    {

        $nav = \App::layoutService()
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