<?php
namespace Platform\Help\Controller\Admin;

use Platform\Help\Form\Admin\CreateHelpPost;
use Platform\Help\Form\Admin\DeleteHelpPost;
use Platform\Help\Form\Admin\EditHelpPost;
use Platform\Help\Form\Admin\FilterHelpPost;
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
                'href'  => app()->routing()->getUrl('admin', ['any' => 'help/manage/create']),
            ],
        ];

        app()->layouts()
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

        app()->layouts()
            ->setPageTitle('help.manage_posts')
            ->setPageFilter($filter);

        $page = $this->request->getParam('page', 1);
        $limit = 10;


        $filter->isValid([
            'topic' => $this->request->getParam('topic'),
            'q'     => $this->request->getParam('q'),
        ]);

        $query = $filter->getData();


        $paging = app()->helpService()
            ->loadAdminPostPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'platform/help/controller/admin/manage/browse-post',
            'item_path' => 'platform/help/paging/admin/browse-post',
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

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            app()->helpService()
                ->addHelpPost($data);

            app()->routing()->redirect('admin', [
                'any' => 'help/manage/browse',
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

        $entry = app()->helpService()
            ->findPostById($id);


        if (!$entry)
            throw new \InvalidArgumentException("There no post");

        $form = new EditHelpPost();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);
            $entry->save();

            app()->routing()->redirect('admin', [
                'any' => 'help/manage/browse',
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

        $entry = app()->helpService()
            ->findPostById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Post not found");

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {

            $entry->delete();

            app()->cacheService()->flush();

            app()->routing()->redirect('admin', [
                'any'    => 'help/manage/browse',
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