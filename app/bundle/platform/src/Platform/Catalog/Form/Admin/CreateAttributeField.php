<?php

namespace Platform\Catalog\Form\Admin;

use Kendo\Html\Form;

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
            'options'  => app()->catalogService()->loadContentTypeOptions(),
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
            'options'  => app()->catalogService()->loadAdminPluginOptions(),
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