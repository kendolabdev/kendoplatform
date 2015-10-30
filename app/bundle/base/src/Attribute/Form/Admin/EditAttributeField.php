<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class EditAttributeField
 *
 * @package Attribute\Form\Admin
 */
class EditAttributeField extends Form
{

    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Edit Attribute Field');
        $this->setNote('Edit attribute catalog');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'field_code',
            'label'    => 'Unique Code',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'field_name',
            'label'    => 'Field Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}