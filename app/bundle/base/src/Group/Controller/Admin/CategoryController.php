<?php
namespace Group\Controller\Admin;

use Group\Form\Admin\CreateGroupCategory;
use Group\Form\Admin\DeleteGroupCategory;
use Group\Form\Admin\EditGroupCategory;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;


/**
 * Class CategoryController
 *
 * @package Group\Controller\Admin
 */
class CategoryController extends AdminController
{

    protected function onBeforeRender()
    {
        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-primary',
                'href'  => \App::routing()->getUrl('admin', ['stuff' => 'group/category/create']),
            ]
        ];

        \App::layout()
            ->setPageName('admin_simple')
            ->setPageButtons([$createButton])
            ->setPageTitle('group.manage_categories')
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_category');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $query = [];
        $page = 1;

        $paging = \App::group()->loadAdminCategoryPaging($query, $page);


        $lp = new BlockParams([
            'base_path' => 'base/group/controller/admin/category/browse-category',
            'item_path' => 'base/group/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'lp'        => $lp,
                'query'     => $query,
                'paging'    => $paging,
                'pagingUrl' => 'admin/group/ajax/category/paging',
            ]);

    }

    /**
     *
     */
    public function actionCreate()
    {
        $form = new CreateGroupCategory();

        $lp = new BlockParams(['base_path' => 'base/core/form-edit']);

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();
            \App::group()->addCategory($data);

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'group/category/browse']);
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

        $entry = \App::group()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new EditGroupCategory();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'group/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'base/core/form-edit']);

        $this->view->setScript($lp->script())
            ->assign(['form' => $form, 'lp' => $lp]);

    }

    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = \App::group()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new DeleteGroupCategory();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $entry->delete();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'group/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'base/core/form-delete']);

        $this->view->setScript($lp->script())
            ->assign(['form' => $form, 'lp' => $lp]);

    }
}