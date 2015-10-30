<?php
namespace Core\Form\MailTransport;

use Setting\Form\Admin\BaseSettingForm;


/**
 * Class SmtpTransport
 *
 * @package Core\Form\MailTransport
 */
class SmtpTransport extends BaseSettingForm
{
    /**
     * @var string
     */
    protected $group = 'mail_smtp';

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('core_form_mailtransport_smtp.form_title');

        $this->setNote('core_form_mailtransport_smtp.form_note');

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'host',
            'label'  => 'core_form_mailtransport_smtp.smtp_host_label',
            'note'   => 'core_form_mailtransport_smtp.smtp_host_note',
            'value'  => '127.0.0.1',
            'class'  => 'form-control',]);
        $this->addElement([
            'plugin' => 'text',
            'name'   => 'port',
            'label'  => 'core_form_mailtransport_smtp.smtp_port_label',
            'note'   => 'core_form_mailtransport_smtp.smtp_port_note',
            'value'  => '25',
            'class'  => 'form-control',]);
        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'auth',
            'label'  => 'core_form_mailtransport_smtp.smtp_auth_label',
            'note'   => 'core_form_mailtransport_smtp.smtp_auth_note',
            'value'  => '1',]);
        $this->addElement([
            'plugin' => 'text',
            'name'   => 'username',
            'label'  => 'core_form_mailtransport_smtp.smtp_username_label',
            'note'   => 'core_form_mailtransport_smtp.smtp_username_note',
            'value'  => '',
            'class'  => 'form-control',]);
        $this->addElement([
            'plugin' => 'text',
            'name'   => 'password',
            'label'  => 'core_form_mailtransport_smtp.smtp_password_label',
            'note'   => 'core_form_mailtransport_smtp.smtp_password_note',
            'value'  => '',
            'class'  => 'form-control',]);
        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'security',
            'label'         => 'core_form_mailtransport_smtp.smtp_security_label',
            'note'          => 'core_form_mailtransport_smtp.smtp_security_note',
            'optionTextKey' => 'core_form_mailtransport_smtp.smtp_security_opt_',
            'value'         => 'none',
            'options'       => [
                ['value' => 'none'],
                ['value' => 'tls'],
                ['value' => 'ssl'],
            ]
        ]);

    }

}