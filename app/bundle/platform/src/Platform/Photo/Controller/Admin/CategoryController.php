<?php
namespace Platform\Photo\Controller\Admin;

use Platform\Photo\Form\Admin\CreatePhotoCategory;
use Platform\Photo\Form\Admin\DeletePhotoCategory;
use Platform\Photo\Form\Admin\EditPhotoCategory;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;


/**
 * Class CategoryController
 *
 * @package Platform\Photo\Controller\Admin
 */
class CategoryController extends AdminController
{

    protected function onBeforeRender()
    {
        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-primary',
                'href'  => \App::routingService()->getUrl('admin', ['stuff' => 'photo/category/create']),
            ]
        ];

        \App::layoutService()
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

        $paging = \App::photoService()->loadAdminCategoryPaging($query, $photo);


        $lp = new BlockParams([
            'base_path' => 'platform/photo/controller/admin/category/browse-category',
            'item_path' => 'platform/photo/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp)
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

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();
            \App::photoService()->addCategory($data);

            \App::cacheService()
                ->flush();

            \App::routingService()->redirect('admin', ['stuff' => 'photo/category/browse']);
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

        $entry = \App::photoService()->findCategoryById($id);

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

            \App::cacheService()
                ->flush();

            \App::routingService()->redirect('admin', ['stuff' => 'photo/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }

    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = \App::photoService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new DeletePhotoCategory();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $entry->delete();

            \App::cacheService()
                ->flush();

            \App::routingService()->redirect('admin', ['stuff' => 'photo/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-delete']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }
}