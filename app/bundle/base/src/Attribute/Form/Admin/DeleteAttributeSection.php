<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class DeleteAttributeSection
 *
 * @package Attribute\Form\Admin
 */
class DeleteAttributeSection extends Form
{

    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Delete Attribute Section');
        $this->setNote('Delete attribute section');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'section_code',
            'label'    => 'Unique Code',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'section_name',
            'label'    => 'Section Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}