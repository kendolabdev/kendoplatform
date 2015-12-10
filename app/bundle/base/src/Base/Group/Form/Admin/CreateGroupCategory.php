<?php

namespace Base\Group\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateGroupCategory
 *
 * @package Group\Form\Admin
 */
class CreateGroupCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Create New Group Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}