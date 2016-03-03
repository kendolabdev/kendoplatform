<?php
namespace Platform\Video\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\Video\Form\Admin\CreateVideoCategory;
use Platform\Video\Form\Admin\DeleteVideoCategory;
use Platform\Video\Form\Admin\EditVideoCategory;

/**
 * Class CategoryController
 *
 * @package Video\Controller\Admin
 */
class CategoryController extends AdminController
{
    /**
     *
     */
    protected function onBeforeRender()
    {
        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-danger',
                'href'  => \App::routing()->getUrl('admin', ['stuff' => 'video/category/create']),
            ]
        ];

        \App::layouts()
            ->setPageName('admin_simple')
            ->setPageTitle('video.manage_categories')
            ->setPageButtons([$createButton])
            ->setupSecondaryNavigation('admin', 'video_extension', 'video_category');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $query = [];
        $page = 1;

        $paging = \App::videoService()->loadAdminCategoryPaging($query, $page);


        $lp = new BlockParams([
            'base_path' => 'platform/video/controller/admin/category/browse-category',
            'item_path' => 'platform/video/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'query'     => $query,
                'paging'    => $paging,
                'pagingUrl' => 'admin/video/ajax/category/paging',
            ]);

    }

    /**
     *
     */
    public function actionCreate()
    {
        $form = new CreateVideoCategory();

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();
            \App::videoService()->addCategory($data);

            \App::cacheService()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'video/category/browse']);
        }

        $this->view->setScript($lp)
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }

    public function actionEdit()
    {
        $id = $this->request->getParam('id');

        $entry = \App::videoService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new EditVideoCategory();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            \App::cacheService()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'video/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }

    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = \App::videoService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new DeleteVideoCategory();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $entry->delete();

            \App::cacheService()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'video/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-delete']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }
}