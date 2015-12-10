<?php

namespace Platform\Catalog\Form;


class PluginMultiCheckboxSetting extends PluginBaseSetting
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
            'name'   => 'inline',
            'label'  => 'Display Inline List',
            'note'   => 'Show as inline list',
            'value'  => '0',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_form_control',
            'label'  => 'Form Control Style',
            'note'   => 'This field presentation as form control',
            'value'  => '1',
        ]);
    }
}

