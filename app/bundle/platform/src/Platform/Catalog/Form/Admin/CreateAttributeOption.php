<?php

namespace Platform\Catalog\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateAttributeOption
 *
 * @package Attribute\Form\Admin
 */
class CreateAttributeOption extends Form
{
    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Create New Attribute Option');
        $this->setNote('Create attribute option');

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