<?php
namespace Layout\Block;

use Picaso\Layout\Block;

/**
 * Class PageHeaderBlock
 *
 * @package Layout\Block
 */
class PageHeaderBlock extends Block
{
    /**
     * @return string
     */
    public function getWrapper()
    {
        return 'none';
    }

    /**
     * Execute
     */
    public function execute()
    {
        $nav = \App::layout()
            ->getSecondaryNavigation();

        $title = \App::layout()
            ->getPageTitle();

        $note = \App::layout()
            ->getPageNote();

        $filter = \App::layout()
            ->getPageFilter();

        if (empty($title)) {
            $this->setNoRender(true);
        }

        $buttons = \App::layout()->getPageButtons();

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