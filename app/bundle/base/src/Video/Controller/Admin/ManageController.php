<?php

namespace Video\Controller\Admin;

use Acl\Form\Admin\FilterAclRole;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use Video\Form\Admin\FilterVideo;
use Video\Form\Admin\VideoPermission;
use Video\Form\Admin\VideoSetting;

/**
 * Class ManageController
 *
 * @package Video\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    public function actionBrowse()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'video_extension', 'video_manage');

        $filter = new FilterVideo();

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $limit = 24;
        $query = $filter->getData();

        $paging = \App::video()
            ->loadVideoPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path'      => 'base/video/controller/admin/manage/browse-video',
            'item_path'      => 'base/video/paging/admin/browse-video',
            'media_position' => 'media-aside-left',
            'grid_md'        => 'col-md-12',
            'grid_sm'        => 'col-sm-12',
            'endless'        => 1,
        ]);

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/video/video/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'filter'    => $filter,
                'query'     => $query,
            ]);
    }


}