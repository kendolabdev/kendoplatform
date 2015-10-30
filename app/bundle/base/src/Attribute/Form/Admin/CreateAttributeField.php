<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class CreateAttributeField
 *
 * @package Attribute\Form\Admin
 */
class CreateAttributeField extends Form
{
    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Create New Attribute Field');
        $this->setNote('Create attribute catalog');

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'content_id',
            'required' => true,
            'options'  => \App::attribute()->loadContentTypeOptions(),
            'label'    => 'For Content Type',
            'class'    => 'form-control',
            'value'    => 'user',
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'required' => true,
            'name'     => 'plugin_id',
            'label'    => 'Presentation',
            'class'    => 'form-control',
            'options'  => \App::attribute()->loadAdminPluginOptions(),
            'value'    => 'text',
        ]);

        $this->addElement([
            'plugin'   => 'text',
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