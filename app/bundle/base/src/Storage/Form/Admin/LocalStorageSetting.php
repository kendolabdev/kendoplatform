<?php

namespace Storage\Form\Admin;

use Picaso\Html\Form;


/**
 * Class LocalStorage
 *
 * @package Storage\Form\Admin
 */
class LocalStorageSetting extends Form
{

    /**
     * Init elements
     */
    protected function init()
    {
        $this->setTitle('core_form_local_storage.form_title');

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'adapter',
            'value'  => 'local',
        ]);

        $this->addElement([
            'name'     => 'basePath',
            'label'    => 'core_form_local_storage.base_path_label', 'note' => 'core_form_local_storage.base_path_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'baseUrl',
            'label'    => 'core_form_local_storage.base_url_label', 'note' => 'core_form_local_storage.base_url_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

    }
}