<?php

namespace Platform\Catalog\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateAttributeSection
 *
 * @package Attribute\Form\Admin
 */
class CreateAttributeSection extends Form
{

    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Create New Attribute Section');
        $this->setNote('Create attribute section');

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'content_id',
            'required' => true,
            'options'  => \App::catalogService()->loadContentTypeOptions(),
            'label'    => 'For Content Type',
            'class'    => 'form-control',
            'value'    => 'user',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'section_code',
            'label'    => 'Unique Code',
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