<?php

namespace Base\Social\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class InstagramSetting
 *
 * @package Social\Form\Admin
 */
class InstagramSetting extends BaseSettingForm
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('instagram_setting.form_title');

        $this->setNote('instagram_setting.form_note');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'instagram__client_id',
            'label'    => 'instagram_setting.client_id',
            'note'     => 'instagram_setting.client_id_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'instagram__client_secret',
            'label'    => 'instagram_setting.client_secret',
            'note'     => 'instagram_setting.client_secret_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

    }
}