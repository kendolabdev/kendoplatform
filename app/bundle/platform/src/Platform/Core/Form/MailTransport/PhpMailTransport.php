<?php

namespace Platform\Core\Form\MailTransport;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class PhpMailTransport
 *
 * @package Core\Form\MailTransport
 */
class PhpMailTransport extends BaseSettingForm
{

    /**
     * @var string
     */
    protected $group = 'mail_php';

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('core_form_mailtransport_php.form_title');

        $this->setNote('core_form_mailtransport_php.form_note');
    }
}