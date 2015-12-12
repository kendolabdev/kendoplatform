<?php

namespace Platform\Event\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateEventCategory
 *
 * @package Event\Form\Admin
 */
class CreateEventCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Create New Event Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}