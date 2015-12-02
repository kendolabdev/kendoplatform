<?php

namespace Layout\Form\Admin;

use Picaso\Html\Form;

class EditBlockPanelDecorator extends Form
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('Select Decorator');

        $this->addElement([
            'name'   => 'decorator',
            'plugin' => 'hidden',
            'value'  => 'panel',
        ]);

        $this->addElement([
            'name'     => 'scheme',
            'label'    => 'Panel contextual',
            'plugin'   => 'radio',
            'value'    => 'panel',
            'required' => true,
            'options'  => [
                ['value' => 'panel-default', 'label' => 'Default'],
                ['value' => 'panel-primary', 'label' => 'Primary'],
                ['value' => 'panel-success', 'label' => 'Success'],
                ['value' => 'panel-info', 'label' => 'Info'],
                ['value' => 'panel-info', 'label' => 'Warning'],
                ['value' => 'panel-danger', 'label' => 'Danger'],
            ],
        ]);

        $this->addElement([
            'name'     => 'scheme',
            'label'    => 'Panel contextual',
            'plugin'   => 'radio',
            'value'    => 'panel',
            'required' => true,
            'options'  => [
                ['value' => 'panel-default', 'label' => 'Default'],
                ['value' => 'panel-primary', 'label' => 'Primary'],
                ['value' => 'panel-success', 'label' => 'Success'],
                ['value' => 'panel-info', 'label' => 'Info'],
                ['value' => 'panel-info', 'label' => 'Warning'],
                ['value' => 'panel-danger', 'label' => 'Danger'],
            ],
        ]);
    }
}
