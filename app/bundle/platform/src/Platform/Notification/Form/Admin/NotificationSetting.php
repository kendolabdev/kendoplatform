<?php
namespace Platform\Notification\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class Platform\NotificationSetting
 *
 * @package Platform\Notification\Form\Admin
 */
class NotificationSetting extends BaseSettingForm
{
    /**
     * @var string
     */
    protected $group = 'notification';

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('notification_form_setting.form_title');

        $this->setNote('notification_form_setting.form_note');

        $this->addElement([
            'plugin'   => 'radio',
            'name'     => 'lifetime',
            'label'    => 'notification_form_setting.lifetime_label',
            'note'     => 'notification_form_setting.lifetime_note',
            'required' => true,
            'options'  => [
                ['value' => 604800, 'label' => '1 week'],
                ['value' => 1209600, 'label' => '2 weeks'],
                ['value' => 1814400, 'label' => '3 weeks'],
                ['value' => 2419200, 'label' => '4 weeks'],
            ],
            'value'    => 604800,
        ]);


    }
}