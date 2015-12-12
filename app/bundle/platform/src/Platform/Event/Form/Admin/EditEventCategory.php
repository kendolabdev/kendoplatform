<?php

namespace Platform\Event\Form\Admin;

use Kendo\Html\Form;

/**
 * Class EditEventCategory
 *
 * @package Event\Form\Admin
 */
class EditEventCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Event Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}