<?php
namespace Platform\Report\Form\Admin;

use Kendo\Html\Form;

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
        $categoryOptions = app()->reportService()->loadCategoryOptions();

        $this->addElement([
            'plugin'  => 'select',
            'name'    => 'category',
            'label'   => 'Category',
            'class'   => 'form-control',
            'options' => $categoryOptions,
        ]);

    }
}