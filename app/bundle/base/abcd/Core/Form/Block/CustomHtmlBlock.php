<?php

namespace Core\Form\Block;

use Kendo\Html\Form;

/**
 * Class CustomHtmlBlock
 *
 * @package Core\Form\Block
 */
class CustomHtmlBlock extends Form
{
    protected function init()
    {
        $this->setTitle('core.custom_html');

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'title',
            'label'       => 'Title',
            'value'       => '',
            'placeholder' => 'Title ... ',
            'required'    => false,
            'class'       => 'form-control',
            'maxlength'   => 100,
        ]);

        $this->addElement([
            'plugin'      => 'textarea',
            'name'        => 'content',
            'label'       => 'Content',
            'placeholder' => 'Html content ... ',
            'required'    => true,
            'class'       => 'form-control'
        ]);
    }
}