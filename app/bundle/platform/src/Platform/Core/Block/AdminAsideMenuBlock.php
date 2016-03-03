<?php
namespace Platform\Core\Block;

use Kendo\Layout\BlockController;

/**
 * Class AdminAsideMenu
 *
 * @package Core\Block
 */
class AdminAsideMenuBlock extends BlockController
{
    /**
     * @var string
     */
    protected $basePath = 'platform/core/block/admin-aside-menu';

    /**
     *
     */
    public function execute()
    {

        $nav = \App::layouts()
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