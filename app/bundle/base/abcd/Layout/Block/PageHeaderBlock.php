<?php
namespace Layout\Block;

use Kendo\Layout\Block;

/**
 * Class PageHeaderBlock
 *
 * @package Layout\Block
 */
class PageHeaderBlock extends Block
{

    /**
     * Execute
     */
    public function execute()
    {
        $nav = \App::layoutService()
            ->getSecondaryNavigation();

        $title = \App::layoutService()
            ->getPageTitle();

        $note = \App::layoutService()
            ->getPageNote();

        $filter = \App::layoutService()
            ->getPageFilter();

        if (empty($title)) {
            $this->setNoRender(true);
        }

        $buttons = \App::layoutService()->getPageButtons();

        $this->view->assign([
            'buttons'  => $buttons,
            'title'    => $title,
            'note'     => $note,
            'nav'      => $nav->getNav(),
            'parentId' => $nav->getParentId(),
            'active'   => $nav->getActive(),
            'filter'   => $filter,
        ]);
    }
}