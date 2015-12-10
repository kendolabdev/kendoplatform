<?php

namespace Platform\User\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class RegisterSetting
 *
 * @package Platform\User\Form\Admin
 */
class RegisterSetting extends BaseSettingForm
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('register_setting.form_title');
        $this->setNote('register_setting.form_note');

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'register__enable',
            'label'  => 'register_setting.enable_label',
            'note'   => 'register_setting.enable_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'register__use_dialog',
            'value'  => '1',
            'label'  => 'register_setting.use_dialog',
            'note'   => 'register_setting.use_dialog_note'
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'register__invite_only',
            'label'  => 'register_setting.invite_only_label',
            'note'   => 'register_setting.invite_only_note',
            'value'  => 0,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'register__friend_auto',
            'label'  => 'register_setting.friend_auto_label',
            'note'   => 'register_setting.friend_auto_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'register__email_verify',
            'label'  => 'register_setting.email_verify_label',
            'note'   => 'register_setting.email_verify_note',
            'value'  => '',
        ]);

        $this->addElement([
            'plugin'  => 'radio',
            'name'    => 'register__email_lifetime',
            'label'   => 'register_setting.email_verify_lifetime_label',
            'note'    => 'register_setting.email_verify_lifetime_note',
            'class'   => 'form-control',
            'options' => [
                ['value' => '86400', 'label' => '1 day'],
                ['value' => '172800', 'label' => '2 day'],
                ['value' => '604800', 'label' => '7 day'],
                ['value' => '2592000', 'label' => '30 day'],
            ],
            'value'   => '2592000',
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'register__approval',
            'label'         => 'register_setting.approval_label',
            'note'          => 'register_setting.approval_note',
            'optionTextKey' => 'register_setting.approval_opt_',
            'value'         => 2,
            'options'       => [
                ['value' => 0],
                ['value' => 1],
                ['value' => 2]
            ],
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'register__notify_admin',
            'label'  => 'register_setting.notify_admin_label',
            'note'   => 'register_setting.notify_admin_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'register__redirect',
            'label'  => 'register_setting.redirect_label',
            'note'   => 'register_setting.redirect_note',
            'class'  => 'form-control',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'register__use_captcha',
            'value'  => '1',
            'label'  => 'register_setting.use_captcha',
            'note'   => 'register_setting.use_captcha_note'
        ]);
    }
}
