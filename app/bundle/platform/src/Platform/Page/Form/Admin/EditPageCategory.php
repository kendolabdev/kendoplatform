<?php

namespace Platform\Page\Form\Admin;

use Kendo\Html\Form;

/**
 * Class EditPageCategory
 *
 * @package Page\Form\Admin
 */
class EditPageCategory extends Form
{

    protected function init()
    {
        $this->setTitle('Edit Page Category');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}