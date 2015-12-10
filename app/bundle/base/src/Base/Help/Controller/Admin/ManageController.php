<?php
namespace Base\Help\Controller\Admin;

use Base\Help\Form\Admin\CreateHelpPost;
use Base\Help\Form\Admin\DeleteHelpPost;
use Base\Help\Form\Admin\EditHelpPost;
use Base\Help\Form\Admin\FilterHelpPost;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Help\Controller\Admin
 */
class ManageController extends AdminController
{
    protected function onBeforeRender()
    {
        $createButton = [
            'label' => 'help.create_new_post',
            'props' => [
                'class' => 'btn btn-sm btn-primary',
                'href'  => \App::routingService()->getUrl('admin', ['stuff' => 'help/manage/create']),
            ],
        ];

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setPageTitle('help.manage_posts')
            ->setPageButtons([$createButton])
            ->setupSecondaryNavigation('admin', 'admin_help', 'manage_post');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterHelpPost();

        \App::layoutService()
            ->setPageTitle('help.manage_posts')
            ->setPageFilter($filter);

        $page = $this->request->getParam('page', 1);
        $limit = 10;


        $filter->isValid([
            'topic' => $this->request->getParam('topic'),
            'q'     => $this->request->getParam('q'),
        ]);

        $query = $filter->getData();


        $paging = \App::helpService()
            ->loadAdminPostPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/help/controller/admin/manage/browse-post',
            'item_path' => 'base/help/paging/admin/browse-post',
        ]);

        $this->view->setScript($lp)
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

            \App::helpService()
                ->addHelpPost($data);

            \App::routingService()->redirect('admin', [
                'stuff' => 'help/manage/browse',
                'topic' => $data['topic_id'],
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

        $entry = \App::helpService()
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

            \App::routingService()->redirect('admin', [
                'stuff' => 'help/manage/browse',
                'topic' => $entry->getTopicId(),
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
        $form = new DeleteHelpPost();
        $id = $this->request->getParam('id');

        $entry = \App::helpService()
            ->findPostById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Post not found");

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cacheService()->flush();

            \App::routingService()->redirect('admin', [
                'stuff'    => 'help/manage/browse',
                'category' => $entry->getTopicId()
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