<?php

namespace Blog\Form\Admin;

use Picaso\Html\Form;

/**
 * Class CreateBlogCategory
 *
 * @package Blog\Form\Admin
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