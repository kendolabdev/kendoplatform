<?php
namespace User\Form\Admin;

use Setting\Form\Admin\BaseSettingForm;

/**
 * Class LoginSetting
 *
 * @package User\Form\Admin
 */
class LoginSetting extends BaseSettingForm
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('login_setting.form_title');
        $this->setNote('login_setting.form_note');

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'login__social_auth',
            'label'  => 'login_setting.social_auth',
            'note'   => 'login_setting.social_auth_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'login__use_captcha',
            'value'  => '1',
            'label'  => 'login_setting.use_captcha',
            'note'   => 'login_setting.use_captcha_note'
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'login__use_dialog',
            'value'  => '1',
            'label'  => 'login_setting.use_dialog',
            'note'   => 'login_setting.use_dialog_note'
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'login__show_remember',
            'value'  => '1',
            'label'  => 'login_setting.show_remember',
            'note'   => 'login_setting.show_remember_note'
        ]);

        $this->addElement([
            'plugin'   => 'radio',
            'required' => true,
            'name'     => 'login__remember_lifetime',
            'label'    => 'login_setting.remember_lifetime',
            'note'     => 'login_setting.remember_lifetime_note',
            'value'    => '7776000',
            'options'  => [
                ['value' => '604800', 'label' => '7 days'],
                ['value' => '2592000', 'label' => '1 month'],
                ['value' => '7776000', 'label' => '3 months'],
                ['value' => '15552000', 'label' => '6 months'],
                ['value' => '31104000', 'label' => '1 year'],
            ],
        ]);


        $this->addElement([
            'plugin' => 'text',
            'name'   => 'login__attempt_limit',
            'label'  => 'login_setting.attempt_limit',
            'note'   => 'login_setting.attempt_limit_note',
            'value'  => '5',
            'class'  => 'form-control'
        ]);

        $this->addElement([
            'plugin'   => 'radio',
            'required' => true,
            'name'     => 'login__attempt_duration',
            'label'    => 'login_setting.attempt_duration',
            'note'     => 'login_setting.attempt_duration_note',
            'value'    => '300',
            'options'  => [
                ['value' => '300', 'label' => '5 minutes'],
                ['value' => '600', 'label' => '10 minutes'],
                ['value' => '900', 'label' => '15 minutes'],
                ['value' => '1800', 'label' => '30 minutes'],
                ['value' => '3600', 'label' => '30 minutes'],
                ['value' => '6000', 'label' => '60 minutes'],
            ],
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'login__redirect_url',
            'label'  => 'login_setting.login_redirect',
            'note'   => 'login_setting.login_redirect_note',
            'value'  => '',
            'class'  => 'form-control'
        ]);
    }

}