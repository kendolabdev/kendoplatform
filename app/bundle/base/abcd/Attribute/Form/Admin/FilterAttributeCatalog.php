<?php

namespace Attribute\Form\Admin;

use Kendo\Html\Form;

/**
 * Class FilterAttributeCatalog
 *
 * @package Attribute\Form\Admin
 */
class FilterAttributeCatalog extends Form
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