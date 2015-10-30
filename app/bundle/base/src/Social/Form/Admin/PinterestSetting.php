<?php

namespace Social\Form\Admin;

use Setting\Form\Admin\BaseSettingForm;

/**
 * Class PinterestSetting
 *
 * @package Social\Form\Admin
 */
class PinterestSetting extends BaseSettingForm
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('pinterest_setting.form_title');

        $this->setNote('pinterest_setting.form_note');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'pinterest__client_id',
            'label'    => 'pinterest_setting.client_id',
            'note'     => 'pinterest_setting.client_id_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'pinterest__client_secret',
            'label'    => 'pinterest_setting.client_secret',
            'note'     => 'pinterest_setting.client_secret_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

    }
}