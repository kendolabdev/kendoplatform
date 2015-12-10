<?php

namespace Base\Page\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreatePageCategory
 *
 * @package Page\Form\Admin
 */
class CreatePageCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Create New Page Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}