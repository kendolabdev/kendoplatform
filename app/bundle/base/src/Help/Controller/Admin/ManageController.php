<?php
namespace Help\Controller\Admin;

use Help\Form\Admin\CreateHelpPost;
use Help\Form\Admin\DeleteHelpPost;
use Help\Form\Admin\EditHelpPost;
use Help\Form\Admin\FilterHelpPost;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Help\Controller\Admin
 */
class ManageController extends AdminController
{
    protected function onBeforeRender()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_help', 'manage_post');
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $page = $this->request->getParam('page', 1);
        $limit = 10;
        $filter = new FilterHelpPost();

        $filter->isValid([
            'topic' => $this->request->getParam('topic'),
            'q'     => $this->request->getParam('q'),
        ]);

        $query = $filter->getData();


        $paging = \App::help()
            ->loadAdminPostPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/help/controller/admin/manage/browse-post',
            'item_path' => 'base/help/paging/admin/browse-post',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'filter'    => $filter,
                'pagingUrl' => 'admin/help/ajax/manage/paging'
            ]);
    }

    public function actionCreate()
    {
        $form = new CreateHelpPost();

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            \App::help()
                ->addHelpPost($data);

            \App::routing()->redirect('admin', [
                'stuff' => 'help/manage/browse',
                'topic' => $data['topic_id'],
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
            ->findPostById($id);


        if (!$entry)
            throw new \InvalidArgumentException("There no post");

        $form = new EditHelpPost();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);
            $entry->save();

            \App::routing()->redirect('admin', [
                'stuff' => 'help/manage/browse',
                'topic' => $entry->getTopicId(),
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
        $form = new DeleteHelpPost();
        $id = $this->request->getParam('id');

        $entry = \App::help()
            ->findPostById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Post not found");

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cache()->flush();

            \App::routing()->redirect('admin', [
                'stuff'    => 'help/manage/browse',
                'category' => $entry->getTopicId()
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