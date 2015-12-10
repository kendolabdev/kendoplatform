<?php

namespace Platform\Acl\Form\Admin;

use Kendo\Html\Form;

/**
 * Class FilterAclRoleType
 *
 * @package Acl\Form\Admin
 */
class FilterAclRoleType extends Form
{
    /**
     * init
     */
    protected function init()
    {
        parent::init();

        $roleTypeOptions = \App::aclService()->getRoleTypeOptions();

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'roleType',
            'label'    => 'Type',
            'required' => true,
            'class'    => 'form-control',
            'value'    => 'en',
            'options'  => $roleTypeOptions,
        ]);
    }
}