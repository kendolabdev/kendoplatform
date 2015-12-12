<?php

namespace Platform\Social\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class TwitterSetting
 *
 * @package Social\Form\Admin
 */
class TwitterSetting extends BaseSettingForm
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('twitter_setting.form_title');

        $this->setNote('twitter_setting.form_note');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'twitter__consumer_key',
            'label'    => 'twitter_setting.consumer_key',
            'note'     => 'twitter_setting.consumer_key_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'twitter__consumer_secret',
            'label'    => 'twitter_setting.consumer_secret',
            'note'     => 'twitter_setting.consumer_secret_note',
            'required' => true,
            'class'    => 'form-control',
        ]);

    }
}