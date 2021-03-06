<?php
namespace Platform\Page\Controller\Admin;

use Platform\Page\Form\Admin\CreatePageCategory;
use Platform\Page\Form\Admin\DeletePageCategory;
use Platform\Page\Form\Admin\EditPageCategory;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;


/**
 * Class CategoryController
 *
 * @package Page\Controller\Admin
 */
class CategoryController extends AdminController
{

    protected function onBeforeRender()
    {

        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-primary',
                'href'  => app()->routing()->getUrl('admin', ['any' => 'page/category/create']),
            ]
        ];

        app()->layouts()
            ->setPageName('admin_simple')
            ->setPageButtons($createButton)
            ->setPageTitle('page.manage_categories')
            ->setupSecondaryNavigation('admin', 'page_extension', 'page_category');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $query = [];
        $page = 1;

        $paging = app()->pageService()->loadAdminCategoryPaging($query, $page);


        $lp = new BlockParams([
            'base_path' => 'platform/page/controller/admin/category/browse-category',
            'item_path' => 'platform/page/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'query'     => $query,
                'paging'    => $paging,
                'pagingUrl' => 'admin/page/ajax/category/paging',
            ]);

    }

    /**
     *
     */
    public function actionCreate()
    {
        $form = new CreatePageCategory();

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();
            app()->pageService()->addCategory($data);

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', ['any' => 'page/category/browse']);
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

        $entry = app()->pageService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new EditPageCategory();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', ['any' => 'page/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }

    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = app()->pageService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new DeletePageCategory();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $entry->delete();

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', ['any' => 'page/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-delete']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }
}