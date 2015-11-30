<?php
namespace Layout\Block;

use Picaso\Layout\Block;

/**
 * Class SidebarMenuBlock
 *
 * @package Layout\Block
 */
class SidebarMenuBlock extends Block
{
    /**
     * @var string
     */
    protected $basePath = 'base/layout/block/sidebar-menu';

    /**
     * @return string
     */
    public function getTitle()
    {
        return '';
    }
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