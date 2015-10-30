<?php
namespace Help\Controller\Admin;

use Help\Form\Admin\CreateHelpPage;
use Help\Form\Admin\DeleteHelpPage;
use Help\Form\Admin\EditHelpPage;
use Help\Form\Admin\FilterHelpPage;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class PageController
 *
 * @package Help\Controller\Admin
 */
class PageController extends AdminController
{
    protected function onBeforeRender()
    {
        \App::layout()
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


        $paging = \App::help()
            ->loadAdminPagePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/help/controller/admin/page/browse-page',
            'item_path' => 'base/help/paging/admin/browse-page',
        ]);

        $this->view->setScript($lp->script())
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

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            \App::help()
                ->addHelpCategory($data);

            \App::routing()->redirect('admin', [
                'stuff' => 'help/page/browse',
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

    public function actionEdit()
    {

        $id = $this->request->getParam('id');

        $entry = \App::help()
            ->findPageById($id);


        if (!$entry)
            throw new \InvalidArgumentException("There no post");

        $form = new EditHelpPage();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);
            $entry->save();

            \App::routing()->redirect('admin', [
                'stuff' => 'help/page/browse',
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
        $form = new DeleteHelpPage();
        $id = $this->request->getParam('id');

        $entry = \App::help()
            ->findPageById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Post not found");

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cache()->flush();

            \App::routing()->redirect('admin', [
                'stuff' => 'help/page/browse',
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