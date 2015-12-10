<?php
namespace Platform\Captcha\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;


/**
 * Class RecaptchaSetting
 *
 * @package Captcha\Form\Admin
 */
class RecaptchaSetting extends BaseSettingForm
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('recaptcha_form_setting.form_title');
        $this->setNote('recaptcha_form_setting.form_note');

        $this->addElement([
            'name'     => 'recaptcha__public_key',
            'label'    => 'recaptcha_form_setting.public_key_label',
            'note'     => 'recaptcha_form_setting.public_key_note',
            'required' => true,
            'class'    => 'form-control'
        ]);

        $this->addElement([
            'name'     => 'recaptcha__private_key',
            'label'    => 'recaptcha_form_setting.private_key_label',
            'note'     => 'recaptcha_form_setting.private_key_note',
            'required' => true,
            'class'    => 'form-control'
        ]);
    }
}