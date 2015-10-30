<?php
namespace Notification\Form\Admin;

use Picaso\Html\Form;


/**
 * Class AlertTypeSetting
 *
 * @package Feed\Form\Admin
 */
class NotificationTypeSetting extends Form
{
    /**
     * @var \Notification\Model\NotificationType
     */
    protected $notificationType;

    /**
     *
     */
    public function load()
    {
        $item = $this->getNotificationType();

        $data = [
            'is_active' => $item->isActive(),
            'is_mail'   => $item->isMail(),
            'is_push'   => $item->isPush(),
            'is_sms'    => $item->isSms(),
            'user_edit' => $item->getUserEdit(),
        ];

        $this->setData($data);
    }

    /**
     *
     */
    public function save()
    {
        $data = $this->getData();

        $item = $this->getNotificationType();

        $item->setActive($data['is_active'] ? 1 : 0);
        $item->setSms($data['is_sms'] ? 1 : 0);
        $item->setMail($data['is_mail'] ? 1 : 0);
        $item->setPush($data['is_push'] ? 1 : 0);
        $item->setUserEdit($data['user_edit'] ? 1 : 0);

        $item->save();

    }

    /**
     *
     */
    protected function init()
    {

        parent::init();

        $item = $this->getNotificationType();


        $this->setTitle($item->getTitle());

        $this->setNote('form_notification_type_setting.form_note');

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_active',
            'label'  => 'form_notification_type_setting.is_active_label',
            'note'   => 'form_notification_type_setting.is_active_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_mail',
            'label'  => 'form_notification_type_setting.is_mail_label',
            'note'   => 'form_notification_type_setting.is_mail_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_push',
            'label'  => 'form_notification_type_setting.is_push_label',
            'note'   => 'form_notification_type_setting.is_push_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_sms',
            'label'  => 'form_notification_type_setting.is_sms_label',
            'note'   => 'form_notification_type_setting.is_sms_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'user_edit',
            'label'  => 'form_notification_type_setting.show_on_user_config_label',
            'note'   => 'form_notification_type_setting.show_on_user_config_note',
            'value'  => 1,
        ]);
    }

    /**
     * @return \Notification\Model\NotificationType
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }

    /**
     * @param \Notification\Model\NotificationType $notificationType
     */
    public function setNotificationType($notificationType)
    {
        $this->notificationType = $notificationType;
    }
}
