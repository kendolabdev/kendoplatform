<?php

namespace Report\Form;

use Picaso\Html\Form;

/**
 * Class AddGeneralReport
 *
 * @package Report\Form
 */
class AddGeneralReport extends Form
{

    /**
     *
     */
    protected function init()
    {

        $this->addElement([
            'plugin' => 'textarea',
            'name'   => 'message',
            'label'  => 'Message',
            'value'  => '',
            'class'  => 'form-control'
        ]);
    }
}