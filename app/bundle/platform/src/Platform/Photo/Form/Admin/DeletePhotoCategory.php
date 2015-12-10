<?php

namespace Platform\Photo\Form\Admin;

use Kendo\Html\Form;

/**
 * Class DeletePhotoCategory
 *
 * @package Platform\Photo\Form\Admin
 */
class DeletePhotoCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Platform\Photo Category');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}