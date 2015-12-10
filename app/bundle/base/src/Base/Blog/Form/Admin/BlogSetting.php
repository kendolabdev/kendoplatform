<?php
namespace Base\Blog\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;

/**
 * Class Base\BlogSetting
 *
 * @package Base\Blog\Form\Admin
 */
class BlogSetting extends BaseSettingForm
{
    /**
     *
     */
    protected function init()
    {
        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'blog__browsing_mode',
            'value'         => '1',
            'label'         => 'blog_setting.browsing_mode',
            'note'          => 'blog_setting.browsing_mode_note',
            'optionTextKey' => 'core_setting.browsing_mode_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1']
            ],
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'blog__browsing_filter',
            'value'         => '1',
            'label'         => 'blog_setting.browsing_filter',
            'note'          => 'blog_setting.browsing_filter_note',
            'optionTextKey' => 'core_setting.browsing_filter_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1'],
                ['value' => '2'],
            ],
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'blog__use_captcha',
            'value'  => '1',
            'label'  => 'blog_setting.use_captcha',
            'note'   => 'blog_setting.use_captcha_note'
        ]);
    }
}

