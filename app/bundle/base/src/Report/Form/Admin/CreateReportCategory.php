<?php

namespace Report\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateReportCategory
 *
 * @package Report\Form\Admin
 */
class CreateReportCategory extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Create Report Category');
        $this->setNote('Members may select category when posting new report about abuse content.');
        $this->addElement([
            'plugin'      => 'text',
            'required'    => true,
            'class'       => 'form-control',
            'label'       => 'Category Name',
            'name'        => 'category_name',
            'value'       => '',
            'placeholder' => 'Category Name'
        ]);
    }
}