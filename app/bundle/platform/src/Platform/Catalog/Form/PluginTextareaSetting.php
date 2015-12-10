<?php

namespace Platform\Catalog\Form;

/**
 * Class PluginTextareaSetting
 *
 * @package Attribute\Form
 */
class PluginTextareaSetting extends PluginBaseSetting
{
    /**
     *
     */
    protected function init()
    {
        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'required',
            'label'  => 'Required',
            'note'   => 'This field is required',
            'value'  => '0',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_form_control',
            'label'  => 'Form Control Style',
            'note'   => 'This field presentation as form control',
            'value'  => '1',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'label'    => 'Placeholder',
            'note'     => 'Placeholder value',
            'name'     => 'placeholder',
            'class'    => 'form-control',
            'required' => false,
        ]);
    }
}

