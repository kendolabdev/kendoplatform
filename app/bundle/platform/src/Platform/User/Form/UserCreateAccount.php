<?php

namespace Platform\User\Form;

use Kendo\Html\Form;

class UserCreateAccount extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('form_user_account.form_title');
        $this->setNote('form_user_account.form_note');
        $this->setAction(\App::routing()->getUrl('register'));

        // show first name last name or display name
        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'name',
            'required'    => true,
            'class'       => 'form-control name',
            'label'       => 'form_user_account.display_name',
            'placeholder' => 'form_user_account.display_name',
        ]);

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'email',
            'required'    => true,
            'label'       => 'form_user_account.email',
            'placeholder' => 'form_user_account.email',
            'class'       => 'form-control email',
        ]);

        $this->addElement([
            'plugin'      => 'password',
            'name'        => 'password password',
            'required'    => true,
            'label'       => 'form_user_account.password',
            'placeholder' => 'form_user_account.password',
            'class'       => 'form-control',
        ]);

        $this->addElement([
            'plugin'      => 'password',
            'name'        => 'password password',
            'required'    => true,
            'label'       => 'form_user_account.password',
            'placeholder' => 'form_user_account.password',
            'class'       => 'form-control',
        ]);

        $this->addElement([
            'plugin'      => 'radio',
            'name'        => 'gender',
            'required'    => true,
            'label'       => 'form_user_account.gender',
            'placeholder' => 'form_user_account.gender',
            'class'       => 'form-control',
            'inline'      => true,
            'options'     => [
                ['value' => 'male', 'label' => 'Male'],
                ['value' => 'female', 'label' => 'Female'],
            ],
        ]);

        $this->addElement([
            'plugin' => 'date',
            'name'   => 'bod',
            'label'  => 'Birth day',
        ]);

        $this->addElement([
            'plugin'   => 'checkbox',
            'required' => true,
            'value'    => 1,
            'label'    => 'I have read and agree to terms of service',
        ]);

        if (\App::setting('register', 'use_captcha')) {
            $this->addElement([
                'label'  => 'I am not robot',
                'plugin' => 'captcha',
            ]);
        }

    }
}