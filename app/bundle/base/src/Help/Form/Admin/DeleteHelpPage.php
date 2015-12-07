<?php

namespace Help\Form\Admin;

use Kendo\Html\Form;

/**
 * Class DeleteHelpPage
 *
 * @package Help\Form\Admin
 */
class DeleteHelpPage extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Delete Page');
        $this->setNote('Delete help page');


        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'page_title',
            'label'    => 'Page Title',
            'class'    => 'form-control',
            'required' => true,
        ]);
    }
}