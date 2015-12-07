<?php

namespace Photo\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreatePhotoCategory
 *
 * @package Photo\Form\Admin
 */
class CreatePhotoCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Create New Photo Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}