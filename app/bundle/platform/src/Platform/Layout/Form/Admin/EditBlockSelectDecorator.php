<?php

namespace Platform\Layout\Form\Admin;

/**
 * Class EditBlockSelectDecorator
 * @package Platform\Layout\Form\Admin
 */
class EditBlockSelectDecorator extends BaseEditBlockDecorator
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('Select Decorator');

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'step',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin'=>'hidden',
            'name'=>'blockId',
        ]);

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
