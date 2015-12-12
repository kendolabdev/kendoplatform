<?php

namespace Platform\Event\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class EventSetting
 *
 * @package Event\Form\Admin
 */
class EventSetting extends BaseSettingForm
{
    protected function init()
    {

        $this->setTitle('event_setting.form_title');
        $this->setNote('event_setting.form_note');

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'event__browsing_mode',
            'value'         => '1',
            'label'         => 'event_setting.browsing_mode',
            'note'          => 'event_setting.browsing_mode_note',
            'optionTextKey' => 'core_setting.browsing_mode_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1']
            ],
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'event__browsing_filter',
            'value'         => '1',
            'label'         => 'event_setting.browsing_filter',
            'note'          => 'event_setting.browsing_filter_note',
            'optionTextKey' => 'core_setting.browsing_filter_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1'],
                ['value' => '2'],
            ],
        ]);
    }


}