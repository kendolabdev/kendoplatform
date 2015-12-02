<?php

namespace Layout\Form\Admin;

/**
 * Class EditBlockPanelDecorator
 * @package Layout\Form\Admin
 */
class EditBlockPanelDecorator extends BaseEditBlockDecorator
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->addElement([
            'name'     => 'scheme',
            'label'    => 'Panel contextual',
            'plugin'   => 'radio',
            'value'    => 'panel-default',
            'inline'   => true,
            'required' => true,
            'options'  => [
                ['value' => 'panel-default', 'label' => 'Default'],
                ['value' => 'panel-primary', 'label' => 'Primary'],
                ['value' => 'panel-success', 'label' => 'Success'],
                ['value' => 'panel-info', 'label' => 'Info'],
                ['value' => 'panel-warning', 'label' => 'Warning'],
                ['value' => 'panel-danger', 'label' => 'Danger'],
            ],
        ]);

        $this->addElement([
            'plugin'  => 'yesno',
            'label'   => 'Has Border',
            'name'    => 'has_border',
            'value' => '1',
        ]);
    }
}
