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
        $nav = \App::layouts()
            ->getSecondaryNavigation();

        $title = \App::layouts()
            ->getPageTitle();

        $note = \App::layouts()
            ->getPageNote();

        $filter = \App::layouts()
            ->getPageFilter();

        if (empty($title)) {
            $this->setNoRender(true);
        }

        $buttons = \App::layouts()->getPageButtons();

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