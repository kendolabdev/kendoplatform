<?php

namespace Photo\Form\Admin;

use Setting\Form\Admin\BaseSettingForm;

/**
 * Class PhotoSetting
 *
 * @package Photo\Form\Admin
 */
class PhotoSetting extends BaseSettingForm
{
    protected function init()
    {

        $this->setTitle('photo_setting.form_title');
        $this->setNote('photo_setting.form_note');

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'photo__browsing_mode',
            'value'         => '1',
            'label'         => 'photo_setting.browsing_mode',
            'note'          => 'photo_setting.browsing_mode_note',
            'optionTextKey' => 'core_setting.browsing_mode_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1']
            ],
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'photo__browsing_filter',
            'value'         => '1',
            'label'         => 'photo_setting.browsing_filter',
            'note'          => 'photo_setting.browsing_filter_note',
            'optionTextKey' => 'core_setting.browsing_filter_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1'],
                ['value' => '2'],
            ],
        ]);
    }


}