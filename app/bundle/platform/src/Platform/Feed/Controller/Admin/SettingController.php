<?php

namespace Platform\Feed\Controller\Admin;

use Platform\Core\Controller\Admin\SettingController as BaseController;
use Platform\Feed\Form\Admin\ActivitySetting;
use Platform\Feed\Form\Admin\AlertTypeSetting;
use Platform\Feed\Form\Admin\FeedTypeSetting;
use Platform\Feed\Form\Admin\FilterFeedType;
use Kendo\Layout\BlockParams;


/**
 * Class SettingController
 *
 * @package Feed\Controller\Admin
 */
class SettingController extends BaseController
{
    protected function onBeforeRender()
    {
        app()->layouts()->setPageName('admin_simple');
        app()->layouts()->setupSecondaryNavigation('admin', 'admin_setting', 'activity_settings');
    }

    /**
     *
     */
    public function actionEdit()
    {

        $form = new ActivitySetting([]);

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $form->save();
        }

        if ($this->request->isMethod('get')) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path' => 'platform/feed/controller/admin/setting/edit-setting',
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);

    }


    /**
     *
     */
    public function actionType()
    {
        $filter = new FilterFeedType();
        $limit = 100;
        $page = 1;
        $filter->isValid([
            'module' => $this->request->getParam('module'),
        ]);

        $query = $filter->getData();

        $paging = app()->feedService()
            ->loadAdminFeedTypePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'platform/feed/controller/admin/setting/browse-type',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'filter' => $filter,
                'paging' => $paging,
                'lp'     => $lp,
                'query'  => $query,
            ]);
    }

    /**
     *
     */
    public function actionEditType()
    {

        $id = $this->request->getString('id', 'user_register');

        $feedType = app()->feedService()
            ->findFeedTypeById($id);

        $form = new FeedTypeSetting([
            'feedType' => $feedType,
        ]);


        if ($this->request->isMethod('get')) {
            $form->load();
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $form->save();
            app()->routing()->redirect('admin', ['any' => 'feed/setting/type']);
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);

    }
}