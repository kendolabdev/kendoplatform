<?php

namespace Platform\Video\Form\Admin;

use Kendo\Html\Form;

/**
 * Class EditVideoCategory
 *
 * @package Video\Form\Admin
 */
class EditVideoCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Video Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}