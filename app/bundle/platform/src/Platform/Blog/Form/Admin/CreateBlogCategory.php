<?php

namespace Platform\Blog\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateBlogCategory
 *
 * @package Base\Blog\Form\Admin
 */
class CreateBlogCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Create New Blog Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}