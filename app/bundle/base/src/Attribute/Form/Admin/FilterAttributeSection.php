<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class FilterAttributeCatalog
 *
 * @package Attribute\Form\Admin
 */
class FilterAttributeSection extends Form
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
            'options'  => \App::attribute()->loadContentTypeOptions(),
            'label'    => 'Content Type',
            'class'    => 'form-control',
            'value'    => 'user',
        ]);
    }
}