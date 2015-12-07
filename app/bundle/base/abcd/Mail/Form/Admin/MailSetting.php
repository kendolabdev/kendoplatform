<?php
namespace Core\Form\Admin;

/**
 * Class MailSetting
 *
 * @package Core\Form\Admin
 */
class MailSetting extends BaseSettingForm
{
    protected function init()
    {

        $this->setTitle('core_mail_setting.form_title');

        $this->setNote('core_mail_setting.form_note');

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'mail__from_name',
            'label'       => 'core_mail_setting.from_name',
            'note'        => 'core_mail_setting.from_name_note',
            'placeholder' => 'Administrators',
            'required'    => 1,
            'class'       => 'form-control',]);

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'mail__from_email',
            'label'       => 'core_mail_setting.from_email',
            'note'        => 'core_mail_setting.from_email_note',
            'required'    => 1,
            'class'       => 'form-control',
            'placeholder' => 'email@domain.com',
        ]);

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'mail__reply_to',
            'label'       => 'core_mail_setting.reply_to',
            'note'        => 'core_mail_setting.reply_to_note',
            'required'    => 1,
            'class'       => 'form-control',
            'placeholder' => 'no-reply@domain.com'
        ]);

        $this->addElement(
            [
                'plugin'        => 'radio',
                'name'          => 'mail__use_queue',
                'label'         => 'core_mail_setting.use_queue',
                'note'          => 'core_mail_setting.use_queue_note',
                'optionTextKey' => 'core_mail_setting.use_queue_opt_',
                'required'      => true,
                'value'         => 0,
                'options'       => [
                    ['value' => '0'],
                    ['value' => '1'],
                ],
            ]);

        $options = [];

        $adapters = \App::table('core.mail_adapter')
            ->select()
            ->all();

        foreach ($adapters as $adapter) {
            $options[] = ['value' => $adapter->getId(), 'label' => $adapter->getName()];
        }

        $this->addElement(
            [
                'plugin'        => 'radio',
                'name'          => 'mail__adapter',
                'label'         => 'core_mail_setting.mail_adapter',
                'note'          => 'core_mail_setting.mail_adapter_note',
                'optionTextKey' => null,
                'required'      => true,
                'value'         => 'mail',
                'options'       => $options,
            ]);

    }
}