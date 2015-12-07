<?php

namespace Group\Form;

use Kendo\Html\Form;

/**
 * Class FormCreateGroup
 *
 * @package Group\Form
 */
class FormCreateGroup extends Form
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
            'placeholder' => 'Group Name',
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