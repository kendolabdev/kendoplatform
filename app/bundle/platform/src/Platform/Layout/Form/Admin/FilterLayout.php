<?php

namespace Platform\Layout\Form\Admin;

use Kendo\Html\Form;


/**
 * Class FilterLayout
 *
 * @package Platform\Layout\Form\Admin
 */
class FilterLayout extends Form
{
    /**
     * init
     */
    protected function init()
    {
        parent::init();


        $moduleOptions = \App::instance()
            ->make('platform_core_extension')
            ->getModuleOptions();

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