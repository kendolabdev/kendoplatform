<?php
namespace Platform\Event\Controller\Admin;

use Platform\Event\Form\Admin\CreateEventCategory;
use Platform\Event\Form\Admin\DeleteEventCategory;
use Platform\Event\Form\Admin\EditEventCategory;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;


/**
 * Class CategoryController
 *
 * @package Event\Controller\Admin
 */
class CategoryController extends AdminController
{

    protected function onBeforeRender()
    {
        $createButton = [
            'label' => 'core.create_new_category',
            'props' => [
                'class' => 'btn btn-sm btn-primary',
                'href'  => \App::routing()->getUrl('admin', ['stuff' => 'photo/category/create']),
            ]
        ];

        \App::layouts()
            ->setPageName('admin_simple')
            ->setPageTitle('event.manage_categories')
            ->setPageButtons([$createButton])
            ->setupSecondaryNavigation('admin', 'event_extension', 'event_category');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $query = [];
        $event = 1;

        $paging = \App::eventService()->loadAdminCategoryPaging($query, $event);


        $lp = new BlockParams([
            'base_path' => 'platform/event/controller/admin/category/browse-category',
            'item_path' => 'platform/event/paging/admin/browse-category',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'query'     => $query,
                'paging'    => $paging,
                'pagingUrl' => 'admin/event/ajax/category/paging',
            ]);

    }

    /**
     *
     */
    public function actionCreate()
    {
        $form = new CreateEventCategory();

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();
            \App::eventService()->addCategory($data);

            \App::cacheService()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'event/category/browse']);
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

        $entry = \App::eventService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new EditEventCategory();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            \App::cacheService()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'event/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-edit']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }

    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = \App::eventService()->findCategoryById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Category does not exists");

        $form = new DeleteEventCategory();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $entry->delete();

            \App::cacheService()
                ->flush();

            \App::routing()->redirect('admin', ['stuff' => 'event/category/browse']);
        }

        $lp = new BlockParams(['base_path' => 'layout/partial/form-delete']);

        $this->view->setScript($lp)
            ->assign(['form' => $form, 'lp' => $lp]);

    }
}