<?php

namespace Platform\User\Form;

use Kendo\Html\Form;

/**
 * Class FilterUser
 *
 * @package Platform\User\Form
 */
class FilterUser extends Form
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'q',
            'label'       => 'Keyword',
            'placeholder' => 'Name, Email, ...',
            'class'       => 'form-control',
            'value'       => ''
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'gender',
            'label'    => 'Browse For',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => '1', 'label' => 'Male'],
                ['value' => '2', 'label' => 'Female'],
                ['value' => '', 'label' => 'All'],
            ],
            'value'    => ''
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'online',
            'label'    => 'Online',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => '1', 'label' => 'Yes'],
                ['value' => '2', 'label' => 'No'],
                ['value' => '', 'label' => 'All'],
            ],
            'value'    => ''
        ]);
    }
}