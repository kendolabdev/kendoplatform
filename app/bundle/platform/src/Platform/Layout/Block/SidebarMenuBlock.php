<?php
namespace Platform\Layout\Block;

use Kendo\Layout\BlockController;

/**
 * Class SidebarMenuBlock
 *
 * @package Platform\Layout\Block
 */
class SidebarMenuBlock extends BlockController
{
    /**
     * @var string
     */
    protected $basePath = 'platform/layout/block/sidebar-menu';

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