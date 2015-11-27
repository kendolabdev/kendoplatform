<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class FilterAttributeField
 *
 * @package Attribute\Form\Admin
 */
class FilterAttributeField extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'content_id',
            'required' => true,
            'options'  => \App::catalogService()->loadContentTypeOptions(),
            'label'    => 'Content Type',
            'class'    => 'form-control',
            'value'    => 'user',
        ]);
    }
}