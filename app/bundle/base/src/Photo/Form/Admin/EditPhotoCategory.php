<?php

namespace Photo\Form\Admin;

use Picaso\Html\Form;

/**
 * Class EditPhotoCategory
 *
 * @package Photo\Form\Admin
 */
class EditPhotoCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Photo Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}