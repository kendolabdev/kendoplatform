<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class EditAttributeOption
 *
 * @package Attribute\Form\Admin
 */
class DeleteAttributeOption extends Form
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
            'plugin'   => 'static',
            'name'     => 'option_name',
            'label'    => 'Option Name',
            'class'    => 'form-control',
        ]);
    }
}