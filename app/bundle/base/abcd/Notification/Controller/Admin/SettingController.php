<?php
namespace Notification\Controller\Admin;

use Notification\Form\Admin\FilterNotificationType;
use Notification\Form\Admin\NotificationSetting;
use Notification\Form\Admin\NotificationTypeSetting;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class SettingController
 *
 * @package Notification\Controller\Admin
 */
class SettingController extends AdminController
{
    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layoutService()->setPageName('admin_simple');
        \App::layoutService()->setupSecondaryNavigation('admin', 'admin_setting', 'admin_setting_notification');
    }

    /**
     *
     */
    public function actionEdit()
    {

        $form = new NotificationSetting();

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path' => 'base/notification/controller/admin/setting/edit-setting',
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

        $filter = new FilterNotificationType();
        $page = 1;
        $limit = 100;

        $filter->isValid([
            'module' => $this->request->getParam('module')
        ]);

        $query = $filter->getData();

        $lp = new BlockParams([
            'base_path' => 'base/notification/controller/admin/setting/browse-type'
        ]);

        $paging = \App::notificationService()
            ->loadAdminNotificationTypePaging($query, $page, $limit);


        $this->view->setScript($lp)
            ->assign([
                'lp'     => $lp,
                'paging' => $paging,
                'query'  => $query,
            ]);
    }

    /**
     *
     */
    public function actionEditType()
    {
        $id = $this->request->getString('id', 'accept_membership_user');

        $notificationType = \App::notificationService()->findNotificationTypeById($id);

        $form = new NotificationTypeSetting([
            'notificationType' => $notificationType
        ]);

        if ($this->request->isGet()) {
            $form->load();
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();

            \App::routingService()->redirect('admin', ['stuff' => 'notification/setting/type']);
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