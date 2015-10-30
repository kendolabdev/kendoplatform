<?php

namespace Page\Form;

use Picaso\Html\Form;

/**
 * Class FormCreatePage
 *
 * @package Page\Form
 */
class FormCreatePage extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->addElement([
            'plugin'      => 'text',
            'label'       => 'Name',
            'name'        => 'name',
            'placeholder' => 'Name',
            'required'    => true,
            'class'       => 'form-control'
        ]);

        $this->addElement([
            'plugin'      => 'text',
            'label'       => 'Description',
            'name'        => 'description',
            'placeholder' => 'Page Name',
            'required'    => true,
            'class'       => 'form-control'
        ]);

        $this->addElement([
            'plugin' => 'submit',
            'name'   => '_submit',
            'label'  => \App::text('core.submit'),
            'class'  => 'btn btn-primary',
        ]);
    }

}