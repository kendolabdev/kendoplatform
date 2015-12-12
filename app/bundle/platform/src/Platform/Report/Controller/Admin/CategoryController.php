<?php
namespace Platform\Report\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\Report\Form\Admin\CreateReportCategory;
use Platform\Report\Form\Admin\EditReportCategory;

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
        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-primary',
                'href'  => \App::routingService()->getUrl('admin', ['stuff' => 'report/category/create']),
            ]
        ];

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setPageButtons([$createButton])
            ->setPageTitle('core.manage_categories')
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

        $paging = \App::reportService()
            ->loadAdminCategoryPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'platform/report/controller/admin/category/browse-category',
            'item_path' => 'platform/report/paging/admin/browse-category',
        ]);


        $this->view->setScript($lp)
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
        $cat = \App::reportService()
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

            \App::cacheService()
                ->flush();

            \App::routingService()
                ->redirect('admin', ['stuff' => 'report/category/browse']);
        }

        $lp = new BlockParams([
            'base_path' => 'platform/report/controller/admin/category/create-category',
        ]);

        $this->view->setScript($lp)
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

            \App::reportService()->addCategory($data);

            \App::cacheService()
                ->flush();

            \App::routingService()
                ->redirect('admin', ['stuff' => 'report/category/browse']);

        }

        $lp = new BlockParams([
            'base_path' => 'platform/report/controller/admin/category/create-category',
        ]);


        $this->view->setScript($lp)
            ->assign([
                'lp'   => $lp,
                'form' => $form,
            ]);
    }
}