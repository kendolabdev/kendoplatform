<?php
namespace Base\Report\Form\Admin;

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
        $categoryOptions = \App::reportService()->loadCategoryOptions();

        $this->addElement([
            'plugin'  => 'select',
            'name'    => 'category',
            'label'   => 'Category',
            'class'   => 'form-control',
            'options' => $categoryOptions,
        ]);

    }
}