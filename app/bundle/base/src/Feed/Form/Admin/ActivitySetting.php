<?php

namespace Feed\Form\Admin;

use Setting\Form\Admin\BaseSettingForm;

/**
 * Class ActivitySetting
 *
 * @package Feed\Form\Admin
 */
class ActivitySetting extends BaseSettingForm
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('activity_setting.form_title');
        $this->setNote('activity_setting.form_note');

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'activity__feed_content',
            'label'         => 'activity_setting.feed_content',
            'note'          => 'activity_setting.feed_content_note',
            'optionTextKey' => 'activity_setting.feed_content_opt_',
            'options'       => [
                ['value' => 0],
                ['value' => 1],
            ],
            'value'         => 'time_asc',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'activity__show_bar_for_guest',
            'value'  => '1',
            'label'  => 'activity_setting.show_bar_for_guest',
            'note'   => 'activity_setting.show_bar_for_guest_note'
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'activity__show_list_for_guest',
            'value'  => '1',
            'label'  => 'activity_setting.show_list_for_guest',
            'note'   => 'activity_setting.show_list_for_guest_note'
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'activity__show_comment',
            'label'  => 'activity_setting.show_comment',
            'note'   => 'activity_setting.show_comment_note',
            'value'  => "1",
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'activity__post_comment',
            'label'  => 'activity_setting.post_comment',
            'note'   => 'activity_setting.post_comment_note',
            'value'  => "1",
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'activity__comment_order',
            'label'         => 'activity_setting.comment_order',
            'note'          => 'activity_setting.comment_order_note',
            'optionTextKey' => 'activity_setting.comment_order_opt_',
            'options'       => [
                ['value' => 'time_asc'],
                ['value' => 'time_desc'],
            ],
            'value'         => 'time_asc',
        ]);


        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'activity__comment_limit',
            'label'         => 'activity_setting.comment_limit',
            'note'          => 'activity_setting.comment_limit_note',
            'optionTextKey' => 'activity_setting.comment_limit_opt_',
            'options'       => [
                ['value' => "3"],
                ['value' => "4"],
                ['value' => "5"],
            ],
            'value'         => '3',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'activity__show_liked',
            'label'  => 'activity_setting.show_liked',
            'note'   => 'activity_setting.show_liked_note',
            'value'  => "1",
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'activity__liked_order',
            'label'         => 'activity_setting.liked_order',
            'note'          => 'activity_setting.liked_order_note',
            'optionTextKey' => 'activity_setting.liked_order_opt_',
            'options'       => [
                ['value' => "0"],
                ['value' => "1"],
            ],
            'value'         => "1"
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'activity__liked_limit',
            'label'         => 'activity_setting.liked_limit',
            'note'          => 'activity_setting.liked_limit_note',
            'required'      => true,
            'optionTextKey' => 'activity_setting.liked_limit_opt_',
            'options'       => [
                ['value' => "1"],
                ['value' => "2"],
                ['value' => "3"],
                ['value' => "4"],
                ['value' => "5"],
            ],
            'value'         => '2',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'activity__show_shared',
            'label'  => 'activity_setting.show_shared',
            'note'   => 'activity_setting.show_shared_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'activity__shared_order',
            'label'  => 'activity_setting.shared_order',
            'note'   => 'activity_setting.shared_order_note',
            'value'  => 1,
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'activity__shared_limit',
            'label'         => 'activity_setting.shared_limit',
            'note'          => 'activity_setting.shared_limit_note',
            'optionTextKey' => 'activity_setting.liked_limit_opt_',
            'options'       => [
                ['value' => "1"],
                ['value' => "2"],
                ['value' => "3"],
                ['value' => "4"],
                ['value' => "5"],
            ],
            'value'         => '2',
        ]);
    }
}
