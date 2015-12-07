<?php

namespace Blog\Form\Admin;

use Kendo\Html\Form;

/**
 * Class EditBlogCategory
 *
 * @package Blog\Form\Admin
 */
class EditBlogCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Blog Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}