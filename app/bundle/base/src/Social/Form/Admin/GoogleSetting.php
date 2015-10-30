<?php

namespace Social\Form\Admin;

use Setting\Form\Admin\BaseSettingForm;

/**
 * Class GoogleSetting
 *
 * @package Social\Form\Admin
 */
class GoogleSetting extends BaseSettingForm
{

    protected function init()
    {
        $this->setTitle('google_setting.form_title');

        $this->setNote('google_setting.form_note');

        $this->addElement([
            'name'     => 'google__project_name',
            'label'    => 'google_setting.project_name',
            'note'     => 'google_setting.project_name_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'google__project_id',
            'required' => true,
            'label'    => 'google_setting.project_id',
            'note'     => 'google_setting.project_id_note',
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'google__project_number',
            'required' => true,
            'label'    => 'google_setting.project_number',
            'note'     => 'google_setting.project_number_note',
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'google__client_id',
            'label'    => 'google_setting.client_id',
            'note'     => 'google_setting.client_id_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'google__client_secret',
            'label'    => 'google_setting.client_secret',
            'note'     => 'google_setting.client_secret_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'google__public_key',
            'label'    => 'google_setting.public_key',
            'note'     => 'google_setting.public_key_note',
            'required' => true,
            'class'    => 'form-control',
        ]);


    }
}