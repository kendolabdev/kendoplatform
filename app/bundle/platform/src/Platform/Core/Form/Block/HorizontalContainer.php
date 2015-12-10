<?php

namespace Platform\Core\Form\Block;

use Kendo\Html\Form;

/**
 * Class HorizontalContainer
 *
 * @package Core\Form\Block
 */
class HorizontalContainer extends Form
{
    protected function init()
    {
        $this->setTitle('core.horizontal_container');

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'grids',
            'label'       => 'Gris',
            'value'       => '',
            'placeholder' => '6,6',
            'required'    => true,
            'class'       => 'form-control',
            'maxlength'   => 100,
        ]);
    }
}