<?php

namespace Platform\Help\Form\Admin;

use Kendo\Html\Form;

/**
 * Class EditHelpPage
 *
 * @package Help\Form\Admin
 */
class EditHelpPage extends Form
{
    protected function init()
    {
        $this->setTitle('Create New Page');


        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'page_title',
            'label'    => 'Title',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'textarea',
            'name'     => 'page_description',
            'label'    => 'Description',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'textarea',
            'name'     => 'page_content',
            'label'    => 'Content',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'yesno',
            'name'     => 'page_active',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}