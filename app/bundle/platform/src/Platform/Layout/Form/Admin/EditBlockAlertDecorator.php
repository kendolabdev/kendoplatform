<?php

namespace Platform\Layout\Form\Admin;

/**
 * Class EditBlockAlertDecorator
 *
 * @package Platform\Layout\Form\Admin
 */
class EditBlockAlertDecorator extends BaseEditBlockDecorator
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('Alert Decorator');

        $this->addElement([
            'name'     => 'scheme',
            'label'    => 'Color Scheme',
            'plugin'   => 'radio',
            'value'    => 'panel-default',
            'inline'   => true,
            'required' => true,
            'options'  => [
                ['value' => 'alert-success', 'label' => 'Success'],
                ['value' => 'alert-info', 'label' => 'Info'],
                ['value' => 'alert-warning', 'label' => 'Warning'],
                ['value' => 'alert-danger', 'label' => 'Danger'],
            ],
        ]);
    }
}
