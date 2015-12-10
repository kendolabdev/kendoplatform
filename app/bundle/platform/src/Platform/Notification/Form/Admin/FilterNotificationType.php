<?php

namespace Platform\Notification\Form\Admin;

use Kendo\Html\Form;

/**
 * Class FilterNotificationType
 *
 * @package Platform\Notification\Form\Admin
 */
class FilterNotificationType extends Form
{
    /**
     * init
     */
    protected function init()
    {
        parent::init();

        $this->addElement([
            'plugin' => 'text',
            'label'  => 'Keyword',
            'name'   => 'q',
            'class'  => 'form-control',
        ]);

        $moduleOptions = \App::extensions()->getModuleOptions();

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'module',
            'label'    => 'Module',
            'required' => false,
            'class'    => 'form-control',
            'value'    => 'core',
            'options'  => $moduleOptions,
        ]);
    }
}