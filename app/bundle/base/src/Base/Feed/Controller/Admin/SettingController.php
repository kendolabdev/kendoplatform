<?php

namespace Base\Feed\Controller\Admin;

use Platform\Core\Controller\Admin\SettingController as BaseController;
use Base\Feed\Form\Admin\ActivitySetting;
use Base\Feed\Form\Admin\AlertTypeSetting;
use Base\Feed\Form\Admin\FeedTypeSetting;
use Base\Feed\Form\Admin\FilterFeedType;
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
        \App::layoutService()->setPageName('admin_simple');
        \App::layoutService()->setupSecondaryNavigation('admin', 'admin_setting', 'activity_settings');
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

        $paging = \App::feedService()
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

        $feedType = \App::feedService()
            ->findFeedTypeById($id);

        $form = new FeedTypeSetting([
            'feedType' => $feedType,
        ]);


        if ($this->request->isGet()) {
            $form->load();
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
            \App::routingService()->redirect('admin', ['stuff' => 'feed/setting/type']);
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