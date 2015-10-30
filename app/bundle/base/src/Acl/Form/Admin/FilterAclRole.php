<?php

namespace Acl\Form\Admin;

use Picaso\Html\Form;

/**
 * Class FilterAclRole
 *
 * @package Acl\Form\Admin
 */
class FilterAclRole extends Form
{
    /**
     * init
     */
    protected function init()
    {
        parent::init();

        $roleOptions = \App::acl()->getRoleOptions();

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'roleId',
            'label'    => 'Role',
            'required' => true,
            'class'    => 'form-control',
            'value'    => 'en',
            'options'  => $roleOptions,
        ]);

    }
}