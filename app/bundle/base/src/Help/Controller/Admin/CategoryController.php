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
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_help', 'manage_category');
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $page = $this->request->getParam('page', 1);
        $limit = 10;
        $query = [];

        $paging = \App::help()
            ->loadCategoryPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/help/controller/admin/category/browse-category',
            'item_path' => 'base/help/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp->script())
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

            \App::help()
                ->addHelpCategory($data);

            \App::routing()->redirect('admin', [
                'stuff' => 'help/category/browse',
            ]);
        }

        $lp = new BlockParams([
            'base_path' => 'base/core/form-edit',
        ]);

        $this->view->setScript($lp->script())
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

        $entry = \App::help()
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

            \App::cache()->flush();

            \App::routing()->redirect('admin', [
                'stuff' => 'help/category/browse',
            ]);
        }

        $lp = new BlockParams([
            'base_path' => 'base/core/form-edit',
        ]);

        $this->view->setScript($lp->script())
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

        $entry = \App::help()
            ->findCategoryById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Topic not found");

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cache()->flush();

            \App::routing()->redirect('admin', [
                'stuff' => 'help/category/browse',
            ]);
        }

        $lp = new BlockParams([
            'base_path' => 'base/core/form-delete',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'form' => $form,
            ]);
    }

}