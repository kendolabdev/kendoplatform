<?php

namespace Picaso\Controller;

use Picaso\Acl\AdminRestrictException;


/**
 * Class AdminController
 *
 * @package Picaso\Controller
 */
class AdminController extends DefaultController
{
    /**
     *
     */
    protected function init()
    {
        if (!\App::aclService()->authorizeFor(\App::authService()->getUser(), 'is_admin'))
            throw new AdminRestrictException("Login required");

        \App::layoutService()
            ->setThemeId('admin');

        \App::registryService()->set('is_admin', true);
    }
}