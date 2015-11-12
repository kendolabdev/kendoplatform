<?php

namespace Event\Controller\Admin;

use Event\Form\Admin\EventSetting;
use Event\Form\Admin\FilterEvent;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package HookEvent\Controller\Admin
 */
class ManageController extends AdminController
{
    /**
     *
     */
    public function actionBrowse()
    {

        $filter = new FilterEvent();

        \App::layout()
            ->setPageName('admin_simple')
            ->setPageTitle('event.manage_events')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'event_extension', 'event_manage');

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $limit = 24;
        $query = $filter->getData();

        $paging = \App::event()
            ->loadEventPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path'      => 'base/event/controller/admin/manage/browse-event',
            'item_path'      => 'base/event/paging/admin/browse-event',
            'media_position' => 'media-aside-left',
            'grid_md'        => 'col-md-12',
            'grid_sm'        => 'col-sm-12',
            'endless'        => 1,
        ]);

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/event/event/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'filter'    => $filter,
            ]);
    }

}