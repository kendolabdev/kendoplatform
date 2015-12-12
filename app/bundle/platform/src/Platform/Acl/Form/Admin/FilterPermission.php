<?php

namespace Platform\Acl\Form\Admin;

use Kendo\Html\Form;

/**
 * Class FilterPermission
 *
 * @package Platform\Acl\Form\Admin
 */
class FilterPermission extends Form
{
    /**
     * init
     */
    protected function init()
    {
        parent::init();

        $this->setMethod('get');

        $roleOptions = \App::aclService()->getRoleOptions();
        $groupOptions = \App::aclService()->getGroupOptions();

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'roleId',
            'label'    => 'Role',
            'required' => true,
            'class'    => 'form-control',
            'value'    => 'en',
            'options'  => $roleOptions,
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'groupId',
            'label'    => 'Permissions',
            'required' => true,
            'class'    => 'form-control',
            'value'    => 'en',
            'options'  => $groupOptions,
        ]);
    }
}