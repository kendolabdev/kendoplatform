<?php

namespace Photo\Form\Admin;

use Picaso\Html\Form;

/**
 * Class DeletePhotoCategory
 *
 * @package Photo\Form\Admin
 */
class DeletePhotoCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Photo Category');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}