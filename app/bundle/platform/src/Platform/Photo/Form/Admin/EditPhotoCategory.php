<?php

namespace Platform\Photo\Form\Admin;

use Kendo\Html\Form;

/**
 * Class EditPhotoCategory
 *
 * @package Platform\Photo\Form\Admin
 */
class EditPhotoCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Platform\Photo Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}