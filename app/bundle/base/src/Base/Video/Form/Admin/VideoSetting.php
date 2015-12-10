<?php

namespace Base\Video\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class VideoSetting
 *
 * @package Video\Form\Admin
 */
class VideoSetting extends BaseSettingForm
{
    protected function init()
    {

        $this->setTitle('video_setting.form_title');
        $this->setNote('video_setting.form_note');

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'video__browsing_mode',
            'value'         => '1',
            'label'         => 'video_setting.browsing_mode',
            'note'          => 'video_setting.browsing_mode_note',
            'optionTextKey' => 'core_setting.browsing_mode_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1']
            ],
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'video__browsing_filter',
            'value'         => '1',
            'label'         => 'video_setting.browsing_filter',
            'note'          => 'video_setting.browsing_filter_note',
            'optionTextKey' => 'core_setting.browsing_filter_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1'],
                ['value' => '2'],
            ],
        ]);
    }


}