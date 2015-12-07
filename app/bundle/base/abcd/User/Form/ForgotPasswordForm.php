<?php
namespace User\Form;

use Kendo\Html\Form;

/**
 * Class ForgotPasswordForm
 *
 * @package User\Form
 */
class ForgotPasswordForm extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('forgot_password_form.form_title');

        $this->setNote('forgot_password_form.form_note');

        $this->addElement([
            'plugin'       => 'email',
            'name'         => 'email',
            'label'        => 'forgot_password_form.email_label',
            'note'         => 'forgot_password_form.email_note',
            'autocomplete' => 'off',
            'required'     => true,
            'rules'        => [
                'required' => ['message' => 'forgot_password_form.email_required'],
            ],
            'class'        => 'form-control'
        ]);
    }
}