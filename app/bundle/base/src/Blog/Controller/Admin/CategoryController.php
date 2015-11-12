<?php
namespace Blog\Controller\Admin;

use Blog\Form\Admin\CreateBlogCategory;
use Blog\Form\Admin\DeleteBlogCategory;
use Blog\Form\Admin\EditBlogCategory;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;


/**
 * Class CategoryController
 *
 * @package Blog\Controller\Admin
 */
class CategoryController extends AdminController
{

    protected function onBeforeRender()
    {
        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-danger',
                'href'  => \App::routing()->getUrl('admin', ['stuff' => 'blog/category/create']),
            ]
        ];

        \App::layout()
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

        $paging = \App::blog()->loadAdminCategoryPaging($query, $page);


        $lp = new BlockParams([
            'base_path' => 'layout/facade/paging-more',
            'item_path' => 'base/blog/paging/admin/browse-category',
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

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();
            \App::blog()->addCategory($data);

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'blog/category/browse']);
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

        $entry = \App::blog()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new EditBlogCategory();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'blog/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }

    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = \App::blog()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new DeleteBlogCategory();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $entry->delete();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'blog/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-delete']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }
}