<?php

namespace Platform\Layout\Form\Admin;

use Kendo\Html\Form;

class BaseEditBlockDecorator extends Form
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('Edit Decorator');

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'step',
            'value'  => 2,
        ]);

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'decorator',
            'value'  => 'panel',
        ]);

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'blockId',
        ]);
    }
}