<?php

namespace Attribute\Form\Admin;

use Kendo\Html\Form;

/**
 * Class DeleteAttributeCatalog
 *
 * @package Attribute\Form\Admin
 */
class DeleteAttributeCatalog extends Form
{

    /**
     * Init code
     */
    protected function init()
    {
        $this->setTitle('Delete Attribute Catalog');
        $this->setNote('Delete attribute catalog');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'content_id',
            'label'    => 'Content Type',
            'required' => true,
            'class'    => 'form-control',
            'value'    => 'user',
        ]);

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'catalog_code',
            'label'    => 'Unique Code',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'catalog_name',
            'label'    => 'Catalog Name',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}