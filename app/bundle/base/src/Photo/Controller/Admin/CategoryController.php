<?php
namespace Photo\Controller\Admin;

use Photo\Form\Admin\CreatePhotoCategory;
use Photo\Form\Admin\DeletePhotoCategory;
use Photo\Form\Admin\EditPhotoCategory;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;


/**
 * Class CategoryController
 *
 * @package Photo\Controller\Admin
 */
class CategoryController extends AdminController
{

    protected function onBeforeRender()
    {
        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-primary',
                'href'  => \App::routing()->getUrl('admin', ['stuff' => 'photo/category/create']),
            ]
        ];

        \App::layout()
            ->setPageName('admin_simple')
            ->setPageButtons([$createButton])
            ->setPageTitle('photo.manage_categories')
            ->setupSecondaryNavigation('admin', 'photo_extension', 'photo_category');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $query = [];
        $photo = 1;

        $paging = \App::photo()->loadAdminCategoryPaging($query, $photo);


        $lp = new BlockParams([
            'base_path' => 'base/photo/controller/admin/category/browse-category',
            'item_path' => 'base/photo/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'lp'        => $lp,
                'query'     => $query,
                'paging'    => $paging,
                'pagingUrl' => 'admin/photo/ajax/category/paging',
            ]);

    }

    /**
     *
     */
    public function actionCreate()
    {
        $form = new CreatePhotoCategory();

        $lp = new BlockParams(['base_path' => 'base/core/form-edit']);

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();
            \App::photo()->addCategory($data);

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'photo/category/browse']);
        }

        $this->view->setScript($lp->script())
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }

    public function actionEdit()
    {
        $id = $this->request->getParam('id');

        $entry = \App::photo()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new EditPhotoCategory();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'photo/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'base/core/form-edit']);

        $this->view->setScript($lp->script())
            ->assign(['form' => $form, 'lp' => $lp]);

    }

    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = \App::photo()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new DeletePhotoCategory();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $entry->delete();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'photo/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'base/core/form-delete']);

        $this->view->setScript($lp->script())
            ->assign(['form' => $form, 'lp' => $lp]);

    }
}