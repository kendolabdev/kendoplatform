<?php

namespace Base\Group\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class GroupSetting
 *
 * @package Group\Form\Admin
 */
class GroupSetting extends BaseSettingForm
{
    protected function init()
    {

        $this->setTitle('group_setting.form_title');
        $this->setNote('group_setting.form_note');

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'group__browsing_mode',
            'value'         => '1',
            'label'         => 'group_setting.browsing_mode',
            'note'          => 'group_setting.browsing_mode_note',
            'optionTextKey' => 'core_setting.browsing_mode_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1']
            ],
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'group__browsing_filter',
            'value'         => '1',
            'label'         => 'group_setting.browsing_filter',
            'note'          => 'group_setting.browsing_filter_note',
            'optionTextKey' => 'core_setting.browsing_filter_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1'],
                ['value' => '2'],
            ],
        ]);
    }


}