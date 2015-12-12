<?php
namespace Platform\Video\Form\Admin;

use Platform\Acl\Form\Admin\BasePermission;

/**
 * Class VideoPermission
 *
 * @package Video\Form\Admin
 */
class VideoPermission extends BasePermission
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('video_form_permission.form_title');
        $this->setNote('video_form_permission.form_note');

        $role = $this->getRole();

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'video__video_tab_exists',
                'label'  => 'video_form_permission.video_tab_exists',
                'note'   => 'video_form_permission.video_tab_exists_note',
                'value'  => '1',
            ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'video__video_tab_view',
            'label'  => 'video_form_permission.video_tab_view',
            'note'   => 'video_form_permission.video_tab_view_note',
            'value'  => '1',
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'video_playlist__create',
                'label'  => 'video_form_permission.playlist_create',
                'note'   => 'video_form_permission.playlist_create_note',
                'value'  => '1',
            ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'video_playlist__view',
            'label'  => 'video_form_permission.playlist_view',
            'note'   => 'video_form_permission.playlist_view_note',
            'value'  => '1',
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'video_playlist__edit',
                'label'  => 'video_form_permission.playlist_edit',
                'note'   => 'video_form_permission.playlist_edit_note',
                'value'  => '1',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'video_playlist__delete',
                'label'  => 'video_form_permission.playlist_delete',
                'note'   => 'video_form_permission.playlist_delete_note',
                'value'  => '1',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'video_playlist__limit',
                'label'  => 'video_form_permission.playlist_limit',
                'note'   => 'video_form_permission.playlist_limit_note',
                'value'  => 20,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'video_playlist__video_limit',
                'label'  => 'video_form_permission.playlist_video_limit',
                'note'   => 'video_form_permission.playlist_video_limit_note',
                'value'  => 200,
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'video__create',
                'label'  => 'video_form_permission.video_create',
                'note'   => 'video_form_permission.video_create_note',
                'value'  => '1',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'video__create',
                'label'  => 'video_form_permission.video_upload',
                'note'   => 'video_form_permission.video_upload_note',
                'value'  => '1',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'video__edit',
                'label'  => 'video_form_permission.video_edit',
                'note'   => 'video_form_permission.video_edit_note',
                'value'  => '1',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'video__delete',
                'label'  => 'video_form_permission.video_delete',
                'note'   => 'video_form_permission.video_delete_note',
                'value'  => '1',
            ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'video__view',
            'label'  => 'video_form_permission.video_view',
            'note'   => 'video_form_permission.video_view_note',
            'value'  => '1',
        ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'select',
                'name'     => 'video__size_max',
                'label'    => 'video_form_permission.video_max_size',
                'note'     => 'video_form_permission.video_max_size_note',
                'value'    => '52428800',
                'required' => true,
                'options'  => [
                    ['value' => '5242880', 'label' => '5 Mb'],
                    ['value' => '10485760', 'label' => '10 Mb'],
                    ['value' => '26214400', 'label' => '25 Mb'],
                    ['value' => '52428800', 'label' => '50 Mb'],
                    ['value' => '104857600', 'label' => '100 Mb'],
                    ['value' => '104857600', 'label' => '100 Mb'],
                    ['value' => '209715200', 'label' => '200 Mb'],
                    ['value' => '524288000', 'label' => '500 Mb'],
                    ['value' => '1048576000', 'label' => '1 GB'],
                    ['value' => '2097152000', 'label' => '2 GB'],
                    ['value' => '4194304000', 'label' => '4 GB'],

                ]
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'video__limit',
                'label'  => 'video_form_permission.video_limit',
                'note'   => 'video_form_permission.video_limit_note',
                'value'  => '10',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'video__upload_limit',
                'label'  => 'video_form_permission.video_upload_limit',
                'note'   => 'video_form_permission.video_upload_limit_note',
                'value'  => '10',
            ]);
    }
}