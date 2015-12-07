<?php
namespace Group\Controller\Admin;

use Group\Form\Admin\CreateGroupCategory;
use Group\Form\Admin\DeleteGroupCategory;
use Group\Form\Admin\EditGroupCategory;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;


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
                'href'  => \App::routingService()->getUrl('admin', ['stuff' => 'group/category/create']),
            ]
        ];

        \App::layoutService()
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

        $paging = \App::groupService()->loadAdminCategoryPaging($query, $page);


        $lp = new BlockParams([
            'base_path' => 'base/group/controller/admin/category/browse-category',
            'item_path' => 'base/group/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp)
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

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();
            \App::groupService()->addCategory($data);

            \App::cacheService()
                ->flush();

            \App::routingService()->redirect('admin', ['stuff' => 'group/category/browse']);
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

        $entry = \App::groupService()->findCategoryById($id);

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

            \App::cacheService()
                ->flush();

            \App::routingService()->redirect('admin', ['stuff' => 'group/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }

    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = \App::groupService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new DeleteGroupCategory();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $entry->delete();

            \App::cacheService()
                ->flush();

            \App::routingService()->redirect('admin', ['stuff' => 'group/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-delete']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }
}