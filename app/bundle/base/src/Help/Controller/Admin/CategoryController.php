<?php
namespace Help\Controller\Admin;

use Help\Form\Admin\CreateHelpCategory;
use Help\Form\Admin\DeleteHelpCategory;
use Help\Form\Admin\EditHelpCategory;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class CategoryController
 *
 * @package Help\Controller\Admin
 */
class CategoryController extends AdminController
{

    protected function onBeforeRender()
    {

        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-primary',
                'href'  => \App::routingService()->getUrl('admin', ['stuff' => 'help/category/create']),
            ]
        ];

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setPageButtons($createButton)
            ->setPageTitle('core.manage_categories')
            ->setupSecondaryNavigation('admin', 'admin_help', 'manage_category');
    }

    /**
     *
     */
    public function actionBrowse()
    {

        \App::layoutService()
            ->setPageTitle('core.manage_categories');

        $page = $this->request->getParam('page', 1);
        $limit = 10;
        $query = [];

        $paging = \App::helpService()
            ->loadCategoryPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/help/controller/admin/category/browse-category',
            'item_path' => 'base/help/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'pagingUrl' => 'admin/help/ajax/category/paging'
            ]);
    }

    public function actionCreate()
    {
        $form = new CreateHelpCategory();

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            \App::helpService()
                ->addHelpCategory($data);

            \App::routingService()->redirect('admin', [
                'stuff' => 'help/category/browse',
            ]);
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }

    /**
     *
     */
    public function actionEdit()
    {
        $form = new EditHelpCategory();
        $id = $this->request->getParam('id');

        $entry = \App::helpService()
            ->findCategoryById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Topic not found");

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);
            $entry->save();

            \App::cacheService()->flush();

            \App::routingService()->redirect('admin', [
                'stuff' => 'help/category/browse',
            ]);
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }

    /**
     *
     */
    public function actionDelete()
    {
        $form = new DeleteHelpCategory();
        $id = $this->request->getParam('id');

        $entry = \App::helpService()
            ->findCategoryById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Topic not found");

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cacheService()->flush();

            \App::routingService()->redirect('admin', [
                'stuff' => 'help/category/browse',
            ]);
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-delete',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }

}