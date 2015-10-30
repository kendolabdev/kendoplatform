<?php

namespace Help\Form\Admin;

use Picaso\Html\Form;

/**
 * Class DeleteHelpCategory
 *
 * @package Help\Form\Admin
 */
class DeleteHelpCategory extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Delete Help Category');
        $this->setNote('Delete help topic');


        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'category_name',
            'label'    => 'Category Name',
            'class'    => 'form-control',
            'required' => true,
        ]);
    }
}