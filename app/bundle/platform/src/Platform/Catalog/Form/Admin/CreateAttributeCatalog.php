<?php

namespace Platform\Catalog\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateAttributeCatalog
 *
 * @package Attribute\Form\Admin
 */
class CreateAttributeCatalog extends Form
{

    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Create New Attribute Catalog');
        $this->setNote('Create attribute catalog');

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'content_id',
            'required' => true,
            'options'  => app()->catalogService()->loadContentTypeOptions(),
            'label'    => 'For Content Type',
            'class'    => 'form-control',
            'value'    => 'user',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'catalog_code',
            'label'    => 'Unique Code',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'catalog_name',
            'label'    => 'Catalog Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}