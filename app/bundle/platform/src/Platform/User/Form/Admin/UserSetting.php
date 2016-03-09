<?php

namespace Platform\User\Form\Admin;

use Kendo\Html\Form;

/**
 * Class Platform\UserSetting
 *
 * @package Platform\User\Form\Admin
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
                ['value' => 'public', 'label' => app()->text('core.public')],
                ['value' => 'invite_only', 'label' => app()->text('core.invite_only')],
                ['value' => 'disabled', 'label' => app()->text('core.disabled')],
            ],
            'value'   => 1,
        ]);

        $this->addElement([
            'plugin'  => 'radio',
            'name'    => 'verify_register_email',
            'label'   => app()->text('core.verify_register_email'),
            'options' => [
                ['value' => 0, 'label' => app()->text('core.no')],
                ['value' => 1, 'label' => app()->text('core.yes')],
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
            'label'   => app()->text('core.user_approval'),
            'options' => [
                ['value' => 0, 'label' => app()->text('core.automatic')],
                ['value' => 1, 'label' => app()->text('core.manually')],
            ],
            'value'   => 1,
        ]);

        $this->addElement([
            'plugin'  => 'radio',
            'name'    => 'register_notify',
            'label'   => app()->text('core.register_notify'),
            'options' => [
                ['value' => 0, 'label' => app()->text('core.no')],
                ['value' => 1, 'label' => app()->text('core.yes')],
            ],
            'value'   => 1,
        ]);

        $this->addElement([
            'plugin' => 'submit',
            'name'   => '_submit',
            'class'  => 'btn btn-primary',
            'label'  => app()->text('core.save_changes')
        ]);
    }
}
