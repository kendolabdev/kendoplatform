<?php

namespace Help\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateHelpCategory
 *
 * @package Help\Form\Admin
 */
class CreateHelpCategory extends Form
{
    protected function init()
    {
        $this->setTitle('Create New Category');
        $this->setNote('Create new help category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'class'    => 'form-control',
            'required' => true,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'category_active',
            'label'  => 'Publish?',
            'value'  => '1',
        ]);
    }

}