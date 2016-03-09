<?php

namespace Platform\Video\Controller\Admin;

use Platform\Acl\Form\Admin\FilterAclRole;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\Video\Form\Admin\FilterVideo;
use Platform\Video\Form\Admin\VideoPermission;
use Platform\Video\Form\Admin\VideoSetting;

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
        $filter = new FilterVideo();

        app()->layouts()
            ->setPageName('admin_simple')
            ->setPageTitle('video.manage_videos')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'video_extension', 'video_manage');

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $limit = 24;
        $query = $filter->getData();

        $paging = app()->videoService()
            ->loadVideoPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path'      => 'platform/video/controller/admin/manage/browse-video',
            'item_path'      => 'platform/video/paging/admin/browse-video',
            'media_position' => 'media-aside-left',
            'grid_md'        => 'col-md-12',
            'grid_sm'        => 'col-sm-12',
            'endless'        => 1,
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/video/video/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'filter'    => $filter,
                'query'     => $query,
            ]);
    }


}