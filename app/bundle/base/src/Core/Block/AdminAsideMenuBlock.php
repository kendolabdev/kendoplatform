<?php
namespace Core\Block;

use Picaso\Layout\Block;

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