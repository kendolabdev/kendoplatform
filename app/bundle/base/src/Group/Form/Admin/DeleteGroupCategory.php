<?php

namespace Group\Form\Admin;

use Picaso\Html\Form;

/**
 * Class DeleteGroupCategory
 *
 * @package Group\Form\Admin
 */
class DeleteGroupCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Group Category');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}