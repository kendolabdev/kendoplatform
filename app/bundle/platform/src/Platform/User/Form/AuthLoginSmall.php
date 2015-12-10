<?php

namespace Platform\User\Form;

use Kendo\Html\Form;

/**
 * Login Form
 * Class AuthLoginSmall
 *
 * @package Platform\User\Form
 */
class AuthLoginSmall extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setMethod('post');

        $this->setAction(\App::routingService()->getUrl('login'));

        $this->addElement([
            'plugin'      => 'email',
            'name'        => 'email',
            'label'       => 'login_form.email',
            'placeholder' => 'login_form.email_placeholder',
            'required'    => true,
            'class'       => 'form-control',
        ]);

        $this->addElement([
            'plugin'      => 'password',
            'name'        => 'password',
            'label'       => 'login_form.password',
            'placeholder' => 'login_form.password_placeholder',
            'required'    => true,
            'class'       => 'form-control',
        ]);

        if (\App::setting('login', 'show_remember')) {
            $this->addElement([
                'plugin'   => 'checkbox',
                'name'     => 'remember',
                'label'    => 'login_form.remember_me',
                'required' => false,
            ]);
        }

        if (\App::setting('login', 'use_captcha')) {
            $this->addElement([
                'plugin' => 'captcha',
            ]);
        }

    }

}