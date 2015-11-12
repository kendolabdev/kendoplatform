<?php

namespace Feed\Controller\Admin;

use Core\Controller\Admin\SettingController as BaseController;
use Feed\Form\Admin\ActivitySetting;
use Feed\Form\Admin\AlertTypeSetting;
use Feed\Form\Admin\FeedTypeSetting;
use Feed\Form\Admin\FilterFeedType;
use Picaso\Layout\BlockParams;


/**
 * Class SettingController
 *
 * @package Feed\Controller\Admin
 */
class SettingController extends BaseController
{
    protected function onBeforeRender()
    {
        \App::layout()->setPageName('admin_simple');
        \App::layout()->setupSecondaryNavigation('admin', 'admin_setting', 'activity_settings');
    }

    /**
     *
     */
    public function actionEdit()
    {

        $form = new ActivitySetting([]);

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path' => 'base/feed/controller/admin/setting/edit-setting',
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

        $paging = \App::feed()
            ->loadAdminFeedTypePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/feed/controller/admin/setting/browse-type',
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

        $feedType = \App::feed()
            ->findFeedTypeById($id);

        $form = new FeedTypeSetting([
            'feedType' => $feedType,
        ]);


        if ($this->request->isGet()) {
            $form->load();
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
            \App::routing()->redirect('admin', ['stuff' => 'feed/setting/type']);
        }

        $lp = new BlockParams([
            'base_path'=> 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);

    }
}