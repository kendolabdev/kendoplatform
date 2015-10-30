<?php
namespace Report\Form\Admin;

use Picaso\Html\Form;

/**
 * Class FilterReport
 *
 * @package Report\Form\Admin
 */
class FilterReport extends Form
{
    /**
     *
     */
    protected function init()
    {
        $categoryOptions = \App::report()->loadCategoryOptions();

        $this->addElement([
            'plugin'  => 'select',
            'name'    => 'category',
            'label'   => 'Category',
            'class'   => 'form-control',
            'options' => $categoryOptions,
        ]);

    }
}