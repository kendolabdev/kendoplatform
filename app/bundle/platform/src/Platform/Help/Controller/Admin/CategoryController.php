<?php
namespace Platform\Help\Controller\Admin;

use Platform\Help\Form\Admin\CreateHelpCategory;
use Platform\Help\Form\Admin\DeleteHelpCategory;
use Platform\Help\Form\Admin\EditHelpCategory;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

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
                'href'  => app()->routing()->getUrl('admin', ['any' => 'help/category/create']),
            ]
        ];

        app()->layouts()
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

        app()->layouts()
            ->setPageTitle('core.manage_categories');

        $page = $this->request->getParam('page', 1);
        $limit = 10;
        $query = [];

        $paging = app()->helpService()
            ->loadCategoryPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'platform/help/controller/admin/category/browse-category',
            'item_path' => 'platform/help/paging/admin/browse-category',
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

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            app()->helpService()
                ->addHelpCategory($data);

            app()->routing()->redirect('admin', [
                'any' => 'help/category/browse',
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

        $entry = app()->helpService()
            ->findCategoryById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Topic not found");

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);
            $entry->save();

            app()->cacheService()->flush();

            app()->routing()->redirect('admin', [
                'any' => 'help/category/browse',
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

        $entry = app()->helpService()
            ->findCategoryById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Topic not found");

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {

            $entry->delete();

            app()->cacheService()->flush();

            app()->routing()->redirect('admin', [
                'any' => 'help/category/browse',
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