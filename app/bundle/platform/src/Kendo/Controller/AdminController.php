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

        if (\App::instance()->isUnitest()) {

        } else {
            if (!\App::aclService()->authorizeFor(\App::authService()->getUser(), 'is_admin'))
                throw new AdminRestrictException("Login required");
        }

        \App::layouts()
            ->setThemeId('admin');

        \App::registryService()->set('is_admin', true);
    }
}