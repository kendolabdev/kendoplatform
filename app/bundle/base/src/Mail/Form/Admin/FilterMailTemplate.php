<?php

namespace Mail\Form\Admin;

use Picaso\Html\Form;

/**
 * Class FilterMailTemplate
 *
 * @package Mail\Form\Admin
 */
class FilterMailTemplate extends Form
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