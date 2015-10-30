<?php
namespace Photo\Controller\Admin;

use Photo\Form\Admin\FilterPhotoAlbum;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

class AlbumController extends AdminController
{
    /**
     *
     */
    public function actionBrowse()
    {

        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'photo_extension', 'album_manage');

        $filter = new FilterPhotoAlbum();

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $limit = 24;
        $query = $filter->getData();

        $paging = \App::photo()
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
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/photo/photo/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'filter'    => $filter,
            ]);
    }
}