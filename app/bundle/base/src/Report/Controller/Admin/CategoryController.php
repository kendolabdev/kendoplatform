<?php
namespace Report\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use Report\Form\Admin\CreateReportCategory;
use Report\Form\Admin\EditReportCategory;

/**
 * Class CategoryController
 *
 * @package Report\Controller\Admin
 */
class CategoryController extends AdminController
{

    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_report', 'manage_category');
    }

    /**
     * Browse abuse report category
     */
    public function actionBrowse()
    {
        $query = [];
        $limit = 100;
        $page = 1;

        $paging = \App::report()
            ->loadAdminCategoryPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/report/controller/admin/category/browse-category',
            'item_path' => 'base/report/paging/admin/browse-category',
        ]);


        $this->view->setScript($lp->script())
            ->assign([
                'lp'        => $lp,
                'query'     => $query,
                'paging'    => $paging,
                'pagingUrl' => 'admin/report/ajax/category/paging',
            ]);

    }

    /**
     * Edit category
     */
    public function actionEdit()
    {
        $id = $this->request->getParam('id');
        $cat = \App::report()
            ->findCategoryById($id);

        if (!$cat)
            throw new \InvalidArgumentException("Category not found");

        $form = new EditReportCategory();

        if ($this->request->isGet()) {
            $form->setData($cat->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();
            $cat->setFromArray($data);
            $cat->save();

            \App::cache()
                ->flush();

            \App::routing()
                ->redirect('admin', ['stuff' => 'report/category/browse']);
        }

        $lp = new BlockParams([
            'base_path' => 'base/report/controller/admin/category/create-category',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'lp'   => $lp,
                'form' => $form,
            ]);
    }

    /**
     * Create new report category
     */
    public function actionCreate()
    {

        $form = new CreateReportCategory();


        if ($this->request->isPost() && $form->isValid($_POST)) {

            $data = $form->getData();

            \App::report()->addCategory($data);

            \App::cache()
                ->flush();

            \App::routing()
                ->redirect('admin', ['stuff' => 'report/category/browse']);

        }

        $lp = new BlockParams([
            'base_path' => 'base/report/controller/admin/category/create-category',
        ]);


        $this->view->setScript($lp->script())
            ->assign([
                'lp'   => $lp,
                'form' => $form,
            ]);
    }
}