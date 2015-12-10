<?php

namespace Base\Event\Form\Admin;

use Kendo\Html\Form;

/**
 * Class DeleteEventCategory
 *
 * @package Event\Form\Admin
 */
class DeleteEventCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Event Category');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}