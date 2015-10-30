<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class EditAttributeSection
 *
 * @package Attribute\Form\Admin
 */
class EditAttributeSection extends Form
{

    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Edit Attribute Section');
        $this->setNote('Edit attribute section');


        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'section_code',
            'label'    => 'Unique Code',
            'disabled' => true,
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'section_name',
            'label'    => 'Section Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}