<?php

namespace Storage\Form\Admin;

use Picaso\Html\Form;

/**
 * Class FtpStorage
 *
 * @package Storage\Form\Admin
 */
class FtpStorageSetting extends Form
{

    /**
     * Init elements
     */
    protected function init()
    {
        $this->setTitle('core_form_ftp_storage.form_title');

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'adapter',
            'value'  => 'ftp',
        ]);

        $this->addElement([
            'name'     => 'basePath',
            'label'    => 'core_form_ftp_storage.base_path_label', 'note' => 'core_form_ftp_storage.base_path_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'baseUrl',
            'label'    => 'core_form_ftp_storage.base_url_label', 'note' => 'core_form_ftp_storage.base_url_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'host',
            'label'    => 'core_form_ftp_storage.host_label', 'note' => 'core_form_ftp_storage.host_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'port',
            'label'    => 'core_form_ftp_storage.port_label', 'note' => 'core_form_ftp_storage.port_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'radio',
            'name'     => 'ssl',
            'label'    => 'core_form_ftp_storage.ssl_label', 'note' => 'core_form_ftp_storage.ssl_note',
            'required' => true,
            'options'  => [
                ['value' => '0', 'label' => 1],
                ['value' => '1', 'label' => 1],
            ],
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'username',
            'label'    => 'core_form_ftp_storage.username_label', 'note' => 'core_form_ftp_storage.username_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'password',
            'label'    => 'core_form_ftp_storage.password_label', 'note' => 'core_form_ftp_storage.password_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'timeout',
            'label'    => 'core_form_ftp_storage.timeout_label', 'note' => 'core_form_ftp_storage.timeout_note',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}