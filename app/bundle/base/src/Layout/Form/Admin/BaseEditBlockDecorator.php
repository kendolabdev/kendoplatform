<?php

namespace Layout\Form\Admin;

use Picaso\Html\Form;

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
            'plugin'=>'hidden',
            'name'=>'blockId',
        ]);
    }
}