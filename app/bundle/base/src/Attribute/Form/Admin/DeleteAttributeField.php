<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class DeleteAttributeField
 *
 * @package Attribute\Form\Admin
 */
class DeleteAttributeField extends Form
{

    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Delete Attribute Field');
        $this->setNote('Delete attribute field');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'field_code',
            'label'    => 'Unique Code',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'field_name',
            'label'    => 'Field Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}