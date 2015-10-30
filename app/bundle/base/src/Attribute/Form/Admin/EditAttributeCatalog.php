<?php

namespace Attribute\Form\Admin;

use Picaso\Html\Form;

/**
 * Class EditAttributeCatalog
 *
 * @package Attribute\Form\Admin
 */
class EditAttributeCatalog extends Form
{

    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Edit Attribute Catalog');
        $this->setNote('Edit attribute catalog');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'content_id',
            'label'    => 'Content Type',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'static',
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