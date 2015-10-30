<?php

namespace Notification\Form\Admin;

use Picaso\Html\Form;

/**
 * Class FilterNotificationType
 *
 * @package Notification\Form\Admin
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