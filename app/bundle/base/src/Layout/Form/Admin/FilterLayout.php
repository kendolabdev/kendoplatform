<?php

namespace Layout\Form\Admin;

use Picaso\Html\Form;


/**
 * Class FilterLayout
 *
 * @package Layout\Form\Admin
 */
class FilterLayout extends Form
{
    /**
     * init
     */
    protected function init()
    {
        parent::init();


        $moduleOptions = \App::extensions()->getModuleOptions();

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'module',
            'label'    => 'Module',
            'required' => true,
            'class'    => 'form-control',
            'value'    => 'core',
            'options'  => $moduleOptions,
        ]);
    }
}