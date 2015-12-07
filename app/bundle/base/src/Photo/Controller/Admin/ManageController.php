<?php

namespace Photo\Controller\Admin;

use Acl\Form\Admin\FilterAclRole;
use Photo\Form\Admin\FilterPhoto;
use Photo\Form\Admin\PhotoPermission;
use Photo\Form\Admin\PhotoSetting;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Photo\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterPhoto();

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setPageTitle('photo.manage_photos')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'photo_extension', 'photo_manage');

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $limit = 24;
        $query = $filter->getData();

        $paging = \App::photoService()
            ->loadPhotoPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path'      => 'base/photo/controller/admin/manage/browse-photo',
            'item_path'      => 'base/photo/paging/admin/browse-photo',
            'media_position' => 'media-aside-left',
            'grid_md'        => 'col-md-12',
            'grid_sm'        => 'col-sm-12',
            'endless'        => 1,
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/photo/photo/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'filter'    => $filter,
            ]);
    }

}