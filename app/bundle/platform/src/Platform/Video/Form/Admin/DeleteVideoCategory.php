<?php

namespace Platform\Video\Form\Admin;

use Kendo\Html\Form;

/**
 * Class DeleteVideoCategory
 *
 * @package Video\Form\Admin
 */
class DeleteVideoCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Delete Video Category');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}