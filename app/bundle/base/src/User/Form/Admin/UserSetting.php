<?php

namespace User\Form\Admin;

use Picaso\Html\Form;

/**
 * Class UserSetting
 *
 * @package User\Form\Admin
 */
class UserSetting extends Form
{
    protected function init()
    {
        $this->addElement([
            'name'  => 'user__tab_default',
            'label' => 'core.user_registration',
        ]);

        $this->addElement([
            'plugin'  => 'radio',
            'name'    => 'register_mode',
            'label'   => 'core.user_registration',
            'options' => [
                ['value' => 'public', 'label' => \App::text('core.public')],
                ['value' => 'invite_only', 'label' => \App::text('core.invite_only')],
                ['value' => 'disabled', 'label' => \App::text('core.disabled')],
            ],
            'value'   => 1,
        ]);

        $this->addElement([
            'plugin'  => 'radio',
            'name'    => 'verify_register_email',
            'label'   => \App::text('core.verify_register_email'),
            'options' => [
                ['value' => 0, 'label' => \App::text('core.no')],
                ['value' => 1, 'label' => \App::text('core.yes')],
            ],
            'value'   => 1,
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'verify_email_timeout',
            'label'  => 'Verify Email Timeout',
            'class'  => 'form-control',
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'changed_email_reauth',
            'label'  => 'Logout after changed email',
            'class'  => 'form-control',
            'value'  => '/',
        ]);

        $this->addElement([
            'plugin'  => 'radio',
            'name'    => 'register_approval',
            'label'   => \App::text('core.user_approval'),
            'options' => [
                ['value' => 0, 'label' => \App::text('core.automatic')],
                ['value' => 1, 'label' => \App::text('core.manually')],
            ],
            'value'   => 1,
        ]);

        $this->addElement([
            'plugin'  => 'radio',
            'name'    => 'register_notify',
            'label'   => \App::text('core.register_notify'),
            'options' => [
                ['value' => 0, 'label' => \App::text('core.no')],
                ['value' => 1, 'label' => \App::text('core.yes')],
            ],
            'value'   => 1,
        ]);

        $this->addElement([
            'plugin' => 'submit',
            'name'   => '_submit',
            'class'  => 'btn btn-primary',
            'label'  => \App::text('core.save_changes')
        ]);
    }
}
