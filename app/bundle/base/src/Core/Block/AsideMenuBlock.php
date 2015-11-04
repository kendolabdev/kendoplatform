<?php
namespace Core\Block;

use Picaso\Layout\Block;

/**
 * Class AdminAsideMenu
 *
 * @package Core\Block
 */
class AsideMenuBlock extends Block
{
    /**
     * @var string
     */
    protected $basePath = 'base/core/block/aside-menu';

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