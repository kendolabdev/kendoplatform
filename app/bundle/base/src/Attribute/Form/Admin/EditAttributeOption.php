<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class EditAttributeOption
 *
 * @package Attribute\Form\Admin
 */
class EditAttributeOption extends Form
{
    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Edit Attribute Option');
        $this->setNote('Edit attribute option');

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'field_id'
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'option_name',
            'label'    => 'Option Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}