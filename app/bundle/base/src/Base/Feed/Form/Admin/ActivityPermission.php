<?php
namespace Base\Feed\Form\Admin;

use Platform\Acl\Form\Admin\BasePermission;


/**
 * Class ActivityPermission
 *
 * @package Feed\Form\Admin
 */
class ActivityPermission extends BasePermission
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('activity_form_permission.form_title');
        $this->setNote('activity_form_permission.form_note');

        $role = $this->getRole();

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'activity__attach_video',
                'label'  => 'activity_form_permission.activity_attach_video',
                'note'   => 'activity_form_permission.activity_attach_video_note',
                'value'  => '1',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'activity__upload_video',
                'label'  => 'activity_form_permission.activity_upload_video',
                'note'   => 'activity_form_permission.activity_upload_video_note',
                'value'  => '1',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'activity__comment_attach_video',
                'label'  => 'activity_form_permission.comment_attach_video',
                'note'   => 'activity_form_permission.comment_attach_video_note',
                'value'  => '1',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'activity__attach_photo',
                'label'  => 'activity_form_permission.activity_attach_photo',
                'note'   => 'activity_form_permission.activity_attach_photo_note',
                'value'  => '1',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'activity__comment_attach_photo',
                'label'  => 'activity_form_permission.comment_attach_photo',
                'note'   => 'activity_form_permission.comment_attach_photo_note',
                'value'  => '1',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__timeline_tab_exists',
                'label'    => 'activity_form_permission.timeline_tab_exists',
                'note'     => 'activity_form_permission.timeline_tab_exists_note',
                'required' => true,
                'value'    => 1,
            ]);
        $this->addElement([
            'plugin'   => 'yesno',
            'name'     => 'activity__timeline_tab_view',
            'label'    => 'activity_form_permission.timeline_tab_view',
            'note'     => 'activity_form_permission.timeline_tab_view_note',
            'required' => true,
            'value'    => 1,
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__like_tab_exists',
                'label'    => 'activity_form_permission.like_tab_exists',
                'note'     => 'activity_form_permission.like_tab_exists_note',
                'required' => true,
                'value'    => 1,
            ]);

        $this->addElement([
            'plugin'   => 'yesno',
            'name'     => 'activity__like_tab_view',
            'label'    => 'activity_form_permission.like_tab_view',
            'note'     => 'activity_form_permission.like_tab_view_note',
            'required' => true,
            'value'    => 1,
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__follower_tab_exists',
                'label'    => 'activity_form_permission.follower_tab_exists',
                'note'     => 'activity_form_permission.follower_tab_exists_note',
                'required' => true,
                'value'    => 1,
            ]);
        $this->addElement([
            'plugin'   => 'yesno',
            'name'     => 'activity__follower_tab_view',
            'label'    => 'activity_form_permission.follower_tab_view',
            'note'     => 'activity_form_permission.follower_tab_view_note',
            'required' => true,
            'value'    => 1,
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__following_tab_exists',
                'label'    => 'activity_form_permission.following_tab_exists',
                'note'     => 'activity_form_permission.following_tab_exists_note',
                'required' => true,
                'value'    => 1,
            ]);

        $this->addElement([
            'plugin'   => 'yesno',
            'name'     => 'activity__following_tab_view',
            'label'    => 'activity_form_permission.following_tab_view',
            'note'     => 'activity_form_permission.following_tab_view_note',
            'required' => true,
            'value'    => 1,
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__like',
                'label'    => 'activity_form_permission.like',
                'note'     => 'activity_form_permission.like_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__comment',
                'label'    => 'activity_form_permission.comment',
                'note'     => 'activity_form_permission.comment_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__share',
                'label'    => 'activity_form_permission.share',
                'note'     => 'activity_form_permission.share_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__update_status',
                'label'    => 'activity_form_permission.update_status',
                'note'     => 'activity_form_permission.update_status_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__edit_update_status',
                'label'    => 'activity_form_permission.update_status_edit',
                'note'     => 'activity_form_permission.update_status_edit_note',
                'required' => true,
                'value'    => 1,
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__check_in',
                'label'    => 'activity_form_permission.check_in',
                'note'     => 'activity_form_permission.check_in_note',
                'required' => true,
                'value'    => 1,
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__follow',
                'label'    => 'activity_form_permission.follow',
                'note'     => 'activity_form_permission.follow_note',
                'required' => true,
                'value'    => 1,
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__mention',
                'label'    => 'activity_form_permission.mention',
                'note'     => 'activity_form_permission.mention_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__comment_mention',
                'label'    => 'activity_form_permission.comment_mention',
                'note'     => 'activity_form_permission.comment_mention_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__hash_tag',
                'label'    => 'activity_form_permission.hash_tag',
                'note'     => 'activity_form_permission.hash_tag_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__attach_link',
                'label'    => 'activity_form_permission.attach_link',
                'note'     => 'activity_form_permission.attach_link_note',
                'required' => true,
                'value'    => 1,
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__comment_attach_link',
                'label'    => 'activity_form_permission.comment_attach_link',
                'note'     => 'activity_form_permission.comment_attach_link_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'activity__attach_people',
                'label'    => 'activity_form_permission.attach_people',
                'note'     => 'activity_form_permission.attach_people_note',
                'required' => true,
                'value'    => 1,
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'text',
                'name'     => 'activity__attach_people_limit',
                'label'    => 'activity_form_permission.attach_people_limit',
                'note'     => 'activity_form_permission.attach_people_limit_note',
                'required' => true,
                'value'    => 20,
            ]);


    }
}