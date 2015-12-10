<?php

namespace Base\Social\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class DribbbleSetting
 *
 * @package Social\Form\Admin
 */
class DribbbleSetting extends BaseSettingForm
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('dribbble_setting.form_title');

        $this->setNote('dribbble_setting.form_note');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'dribbble__client_id',
            'label'    => 'dribbble_setting.client_id',
            'note'     => 'dribbble_setting.client_id_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'dribbble__client_secret',
            'label'    => 'dribbble_setting.client_secret',
            'note'     => 'dribbble_setting.client_secret_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

    }
}