<?php

namespace Platform\Feed\Form\Admin;

use Kendo\Html\Form;

/**
 * Class FilterFeedType
 *
 * @package Feed\Form\Admin
 */
class FilterFeedType extends Form
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

        $moduleOptions = app()->instance()
            ->make('platform_core_extension')
            ->getModuleOptions();

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