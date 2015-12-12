<?php
namespace Platform\Help\Controller\Admin;

use Platform\Help\Form\Admin\CreateHelpTopic;
use Platform\Help\Form\Admin\DeleteHelpTopic;
use Platform\Help\Form\Admin\EditHelpTopic;
use Platform\Help\Form\Admin\FilterHelpTopic;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class TopicController
 *
 * @package Help\Controller\Admin
 */
class TopicController extends AdminController
{
    protected function onBeforeRender()
    {
        \App::layoutService()
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


        $paging = \App::helpService()
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

            \App::helpService()
                ->addHelpTopic($data);

            \App::routingService()->redirect('admin', [
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

        $entry = \App::helpService()
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

            \App::cacheService()->flush();

            \App::routingService()->redirect('admin', [
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

        $entry = \App::helpService()
            ->findTopicById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Topic not found");

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }


        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cacheService()->flush();

            \App::routingService()->redirect('admin', [
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