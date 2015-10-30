<?php

namespace User\Controller\Admin;

use Picaso\Controller\AdminController;

/**
 * Class AttributeController
 *
 * @package User\Controller\Admin
 */
class AttributeController extends AdminController
{

    protected function onBeforeRender()
    {
        \App::layout()
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