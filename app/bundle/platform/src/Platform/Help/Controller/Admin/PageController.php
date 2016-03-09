<?php
namespace Platform\Help\Controller\Admin;

use Platform\Help\Form\Admin\CreateHelpPage;
use Platform\Help\Form\Admin\DeleteHelpPage;
use Platform\Help\Form\Admin\EditHelpPage;
use Platform\Help\Form\Admin\FilterHelpPage;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class PageController
 *
 * @package Help\Controller\Admin
 */
class PageController extends AdminController
{
    protected function onBeforeRender()
    {
        app()->layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_help', 'manage_page');
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $page = $this->request->getParam('page', 1);
        $limit = 10;

        $filter = new FilterHelpPage();

        $filter->isValid([
            'q' => $this->request->getParam('q'),
        ]);

        $query = $filter->getData();


        $paging = app()->helpService()
            ->loadAdminPagePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'platform/help/controller/admin/page/browse-page',
            'item_path' => 'platform/help/paging/admin/browse-page',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'filter'    => $filter,
                'pagingUrl' => 'admin/help/ajax/page/paging'
            ]);
    }

    public function actionCreate()
    {
        $form = new CreateHelpPage();

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            app()->helpService()
                ->addHelpCategory($data);

            app()->routing()->redirect('admin', [
                'any' => 'help/page/browse',
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

    public function actionEdit()
    {

        $id = $this->request->getParam('id');

        $entry = app()->helpService()
            ->findPageById($id);


        if (!$entry)
            throw new \InvalidArgumentException("There no post");

        $form = new EditHelpPage();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);
            $entry->save();

            app()->routing()->redirect('admin', [
                'any' => 'help/page/browse',
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
        $form = new DeleteHelpPage();
        $id = $this->request->getParam('id');

        $entry = app()->helpService()
            ->findPageById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Post not found");

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {

            $entry->delete();

            app()->cacheService()->flush();

            app()->routing()->redirect('admin', [
                'any' => 'help/page/browse',
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