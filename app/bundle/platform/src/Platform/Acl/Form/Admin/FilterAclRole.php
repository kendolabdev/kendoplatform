<?php

namespace Platform\Acl\Form\Admin;

use Kendo\Html\Form;

/**
 * Class FilterAclRole
 *
 * @package Platform\Acl\Form\Admin
 */
class FilterAclRole extends Form
{
    /**
     * init
     */
    protected function init()
    {
        parent::init();

        $roleOptions = app()->aclService()->getRoleOptions();

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