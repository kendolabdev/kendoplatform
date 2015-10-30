<?php

namespace Social\Form\Admin;

use Setting\Form\Admin\BaseSettingForm;

/**
 * Class FacebookSetting
 *
 * @package Social\Form\Admin
 */
class FacebookSetting extends BaseSettingForm
{

    /**
     *
     */
    protected function init()
    {

        $this->setTitle('facebook_setting.form_title');

        $this->setNote('facebook_setting.form_note');

        $this->addElement([
            'name'     => 'facebook__app_name',
            'label'    => 'facebook_setting.app_name',
            'note'     => 'facebook_setting.app_name_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'facebook__app_id',
            'label'    => 'facebook_setting.app_id',
            'note'     => 'facebook_setting.app_id_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'name'     => 'facebook__secret',
            'label'    => 'facebook_setting.app_secret',
            'note'     => 'facebook_setting.app_secret_note',
            'required' => true,
            'class'    => 'form-control',
        ]);
    }
}