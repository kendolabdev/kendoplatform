<?php

namespace Platform\Group\Form\Admin;

use Kendo\Html\Form;


/**
 * Class FilterGroup
 *
 * @package Group\Form\Admin
 */
class FilterGroup extends Form
{
    protected function init()
    {
        parent::init();

        $this->addElement([
            'plugin' => 'text',
            'label'  => 'Keyword',
            'name'   => 'q',
            'class'  => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'gender',
            'label'    => 'Gender',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => 'all', 'label' => 'All'],
                ['value' => 'male', 'label' => 'Male'],
                ['value' => 'female', 'label' => 'Female'],
            ]
        ]);

        $roleOptions = app()->aclService()->getRoleOptions('group');

        array_unshift($roleOptions, ['value' => 'all', 'label' => 'All']);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'role',
            'label'    => 'Role',
            'required' => true,
            'class'    => 'form-control',
            'options'  => $roleOptions
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'approve',
            'label'    => 'Approval',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => 'all', 'label' => 'All'],
                ['value' => '0', 'label' => 'No'],
                ['value' => '1', 'label' => 'Approved'],
            ]
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'active',
            'label'    => 'Active',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => 'all', 'label' => 'All'],
                ['value' => '0', 'label' => 'No'],
                ['value' => '1', 'label' => 'Active'],
            ]
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'created',
            'label'    => 'Created',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => 'all', 'label' => 'All'],
                ['value' => '1hour', 'label' => '60 minutes'],
                ['value' => 'today', 'label' => 'Today'],
                ['value' => '24hours', 'label' => '24 hours'],
                ['value' => '7days', 'label' => '7 days'],
                ['value' => '30days', 'label' => '30 days'],
                ['value' => 'this_month', 'label' => 'This month'],
                ['value' => '30days', 'label' => 'This year'],
            ]
        ]);
    }
}