<?php
namespace Platform\Layout\Block;

use Kendo\Layout\BlockController;

/**
 * Class PageHeaderBlock
 *
 * @package Platform\Layout\Block
 */
class PageHeaderBlock extends BlockController
{

    /**
     * Execute
     */
    public function execute()
    {
        $nav = app()->layouts()
            ->getSecondaryNavigation();

        $title = app()->layouts()
            ->getPageTitle();

        $note = app()->layouts()
            ->getPageNote();

        $filter = app()->layouts()
            ->getPageFilter();

        if (empty($title)) {
            $this->setNoRender(true);
        }

        $buttons = app()->layouts()->getPageButtons();

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