<?php

namespace Layout\Form\Admin;

use Picaso\Html\Form;

class EditBlockDecorator extends Form
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('Select Decorator');

        $this->addElement([
            'name'     => 'decorator',
            'label'    => 'Decorator',
            'plugin'   => 'radio',
            'value'    => 'panel',
            'required' => true,
            'options'  => [
                ['value' => 'none', 'label' => 'None'],
                ['value' => 'panel', 'label' => 'Panel'],
                ['value' => 'default', 'label' => 'Default'],
                ['value' => 'widget', 'label' => 'Widget'],
                ['value' => 'alert', 'label' => 'Alert'],
            ],
        ]);
    }
}
