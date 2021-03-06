<?php

namespace Platform\Video\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateVideoCategory
 *
 * @package Video\Form\Admin
 */
class CreateVideoCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Create New Video Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}