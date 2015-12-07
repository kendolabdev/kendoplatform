<?php

namespace User\Controller\Admin;

use Kendo\Controller\AdminController;

/**
 * Class AttributeController
 *
 * @package User\Controller\Admin
 */
class AttributeController extends AdminController
{

    protected function onBeforeRender()
    {
        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_attribute');

    }

    /**
     * Browse all user template
     */
    public function actionBrowse()
    {

    }
}