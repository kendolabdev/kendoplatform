<?php

namespace Core\Form\MailTransport;

use Picaso\Html\Form;

/**
 * Class SelectTransport
 *
 * @package Core\Form\MailTransport
 */
class SelectTransport extends Form
{
    /**
     *
     */
    protected function init()
    {

        $this->setTitle('core_form_mail_select_transport.form_title');
        $this->setNote('core_form_mail_select_transport.form_note');

        $options = [];

        $adapters = \App::table('core.mail_adapter')
            ->select()
            ->where('id <> ?', 'mail')
            ->all();

        foreach ($adapters as $adapter) {
            $options[] = [
                'value' => $adapter->getId(),
            ];
        }

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'adapterId',
            'label'         => 'core_form_mail_setting.tranport_label',
            'note'          => 'core_form_mail_setting.tranport_note',
            'optionTextKey' => 'core_form_mail_setting.tranport_opt_',
            'value'         => 'smtp',
            'options'       => $options]);

        $this->addElement([
            'plugin' => 'submit',
            'name'   => '_submit',
            'label'  => \App::text('core.continue'),
            'class'  => 'btn btn-primary btn-sm'
        ]);
    }
}