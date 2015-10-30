<?php

namespace Social\Form\Admin;

use Setting\Form\Admin\BaseSettingForm;

/**
 * Class LinkedInSetting
 *
 * @package Social\Form\Admin
 */
class LinkedInSetting extends BaseSettingForm
{
    /**
     *
     */
    protected function init()
    {

        $this->setTitle('linkedin_setting.form_title');

        $this->setNote('linkedin_setting.form_note');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'linkedin__app_name',
            'label'    => 'linkedin_setting.app_name',
            'note'     => 'linkedin_setting.app_name_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'linkedin__client_id',
            'label'    => 'linkedin_setting.client_id',
            'note'     => 'linkedin_setting.client_id_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'linkedin__client_secret',
            'label'    => 'linkedin_setting.client_secret',
            'note'     => 'linkedin_setting.client_secret_note',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}