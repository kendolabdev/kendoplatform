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
        if (!\App::acl()->authorizeFor(\App::auth()->getUser(), 'is_admin'))
            throw new AdminRestrictException("Login required");

        \App::layout()
            ->setThemeId('admin');

        \App::registry()->set('is_admin', true);
    }
}