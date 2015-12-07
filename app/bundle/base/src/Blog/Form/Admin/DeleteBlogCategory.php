<?php

namespace Blog\Form\Admin;

use Kendo\Html\Form;

/**
 * Class DeleteBlogCategory
 *
 * @package Blog\Form\Admin
 */
class DeleteBlogCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Blog Category');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}