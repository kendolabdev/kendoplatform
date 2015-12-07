<?php

namespace Page\Form\Admin;

use Kendo\Html\Form;

/**
 * Class DeletePageCategory
 *
 * @package Page\Form\Admin
 */
class DeletePageCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Page Category');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}