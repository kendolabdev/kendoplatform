<?php

namespace Page\Form\Admin;

use Setting\Form\Admin\BaseSettingForm;

/**
 * Class PageSetting
 *
 * @package Page\Form\Admin
 */
class PageSetting extends BaseSettingForm
{
    protected function init()
    {

        $this->setTitle('page_setting.form_title');
        $this->setNote('page_setting.form_note');

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'page__browsing_mode',
            'value'         => '1',
            'label'         => 'page_setting.browsing_mode',
            'note'          => 'page_setting.browsing_mode_note',
            'optionTextKey' => 'core_setting.browsing_mode_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1']
            ],
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'page__browsing_filter',
            'value'         => '1',
            'label'         => 'page_setting.browsing_filter',
            'note'          => 'page_setting.browsing_filter_note',
            'optionTextKey' => 'core_setting.browsing_filter_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1'],
                ['value' => '2'],
            ],
        ]);
    }


}