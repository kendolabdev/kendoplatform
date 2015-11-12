<?php
namespace Help\Controller\Admin;

use Help\Form\Admin\CreateHelpTopic;
use Help\Form\Admin\DeleteHelpTopic;
use Help\Form\Admin\EditHelpTopic;
use Help\Form\Admin\FilterHelpTopic;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class TopicController
 *
 * @package Help\Controller\Admin
 */
class TopicController extends AdminController
{
    protected function onBeforeRender()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_help', 'manage_topic');
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $page = $this->request->getParam('page', 1);
        $limit = 10;
        $filter = new FilterHelpTopic();

        $filter->isValid([
            'category' => $this->request->getParam('category'),
            'q'        => $this->request->getParam('q'),
        ]);

        $query = $filter->getData();


        $paging = \App::help()
            ->loadAdminTopicPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/help/controller/admin/topic/browse-topic',
            'item_path' => 'base/help/paging/admin/browse-topic',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'filter'    => $filter,
                'pagingUrl' => 'admin/help/ajax/topic/paging'
            ]);
    }

    public function actionCreate()
    {
        $form = new CreateHelpTopic();

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            \App::help()
                ->addHelpTopic($data);

            \App::routing()->redirect('admin', [
                'stuff' => 'help/topic/browse',
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
        $form = new EditHelpTopic();
        $id = $this->request->getParam('id');

        $entry = \App::help()
            ->findTopicById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Topic not found");

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);
            $entry->save();

            \App::cache()->flush();

            \App::routing()->redirect('admin', [
                'stuff'    => 'help/topic/browse',
                'category' => $entry->getCategoryId(),
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
        $form = new DeleteHelpTopic();
        $id = $this->request->getParam('id');

        $entry = \App::help()
            ->findTopicById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Topic not found");

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cache()->flush();

            \App::routing()->redirect('admin', [
                'stuff'    => 'help/topic/browse',
                'category' => $entry->getCategoryId(),
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