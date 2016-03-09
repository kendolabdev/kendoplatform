<?php

namespace Kendo\Controller;

use Kendo\Acl\AdminRestrictException;


/**
 * Class AdminController
 *
 * @package Kendo\Controller
 */
class AdminController extends DefaultController
{
    /**
     *
     */
    protected function init()
    {

        if (app()->instance()->isUnitest()) {

        } else {
            if (!app()->aclService()->authorizeFor(app()->auth()->getUser(), 'is_admin'))
                throw new AdminRestrictException("Login required");
        }

        app()->layouts()
            ->setThemeId('admin');

        app()->registryService()->set('is_admin', true);
    }
}