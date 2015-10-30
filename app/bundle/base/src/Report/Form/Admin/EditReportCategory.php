<?php

namespace Report\Form\Admin;

use Picaso\Html\Form;

/**
 * Class EditReportCategory
 *
 * @package Report\Form\Admin
 */
class EditReportCategory extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Edit Report Category');
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