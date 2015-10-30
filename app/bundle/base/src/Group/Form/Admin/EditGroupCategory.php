<?php

namespace Group\Form\Admin;

use Picaso\Html\Form;

/**
 * Class EditGroupCategory
 *
 * @package Group\Form\Admin
 */
class EditGroupCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Group Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}