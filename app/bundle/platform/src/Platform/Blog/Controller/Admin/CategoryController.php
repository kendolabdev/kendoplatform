<?php
namespace Platform\Blog\Controller\Admin;

use Platform\Blog\Form\Admin\CreateBlogCategory;
use Platform\Blog\Form\Admin\DeleteBlogCategory;
use Platform\Blog\Form\Admin\EditBlogCategory;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;


/**
 * Class CategoryController
 *
 * @package Base\Blog\Controller\Admin
 */
class CategoryController extends AdminController
{

    protected function onBeforeRender()
    {
        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-danger',
                'href'  => app()->routing()->getUrl('admin', ['any' => 'blog/category/create']),
            ]
        ];

        app()->layouts()
            ->setPageName('admin_simple')
            ->setPageTitle('blog.manage_categories')
            ->setPageButtons([$createButton])
            ->setupSecondaryNavigation('admin', 'blog_extension', 'blog_category');
    }

    /**
     *
     */
    public function actionBrowse()
    {


        $query = [];
        $page = 1;

        $paging = app()->blogService()->loadAdminCategoryPaging($query, $page);


        $lp = new BlockParams([
            'base_path' => 'layout/facade/paging-more',
            'item_path' => 'platform/blog/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'query'     => $query,
                'paging'    => $paging,
                'pagingUrl' => 'admin/blog/ajax/category/paging',
            ]);

    }

    /**
     *
     */
    public function actionCreate()
    {
        $form = new CreateBlogCategory();

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();
            app()->blogService()->addCategory($data);

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', ['any' => 'blog/category/browse']);
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

        $entry = app()->blogService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new EditBlogCategory();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', ['any' => 'blog/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }

    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = app()->blogService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new DeleteBlogCategory();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $entry->delete();

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', ['any' => 'blog/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-delete']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }
}