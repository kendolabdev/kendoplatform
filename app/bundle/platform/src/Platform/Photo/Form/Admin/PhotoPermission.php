<?php
namespace Platform\Photo\Form\Admin;

use Platform\Acl\Form\Admin\BasePermission;

/**
 * Class Platform\PhotoPermission
 *
 * @package Platform\Photo\Form\Admin
 */
class PhotoPermission extends BasePermission
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('photo_form_permission.form_title');
        $this->setNote('photo_form_permission.form_note');

        $role = $this->getRole();

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'photo__photo_tab_exists',
                'label'  => 'photo_form_permission.photo_tab_exists',
                'note'   => 'photo_form_permission.photo_tab_exists_note',
                'value'  => 1,
            ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'photo__photo_tab_view',
            'label'  => 'photo_form_permission.photo_tab_view',
            'note'   => 'photo_form_permission.photo_tab_view_note',
            'value'  => 1,
        ]);


        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'photo__create',
                'label'  => 'photo_form_permission.create_photo',
                'note'   => 'photo_form_permission.create_photo_note',
                'value'  => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'photo__edit',
                'label'  => 'photo_form_permission.edit_photo',
                'note'   => 'photo_form_permission.edit_photo_note',
                'value'  => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'photo__delete',
                'label'  => 'photo_form_permission.photo_delete',
                'note'   => 'photo_form_permission.photo_delete_note',
                'value'  => 1,
            ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'photo__view',
            'label'  => 'photo_form_permission.photo_view',
            'note'   => 'photo_form_permission.photo_view_note',
            'value'  => 1,
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'photo__album_limit',
                'label'  => 'photo_form_permission.album_limit',
                'note'   => 'photo_form_permission.album_limit_note',
                'value'  => '20',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'photo__album_photo_limit',
                'label'  => 'photo_form_permission.album_photo_limit',
                'note'   => 'photo_form_permission.album_photo_limit_note',
                'value'  => '200',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'select',
                'name'     => 'photo__max_size',
                'label'    => 'photo_form_permission.photo_max_size',
                'note'     => 'photo_form_permission.photo_max_size_note',
                'value'    => '10485760',
                'required' => true,
                'options'  => [
                    ['value' => '512000', 'label' => '500 Kb'],
                    ['value' => '1048576', 'label' => '1 Mb'],
                    ['value' => '2097152', 'label' => '2 Mb'],
                    ['value' => '5242880', 'label' => '5 Mb'],
                    ['value' => '10485760', 'label' => '10 Mb'],
                    ['value' => '26214400', 'label' => '25 Mb'],
                    ['value' => '52428800', 'label' => '50 Mb'],
                    ['value' => '104857600', 'label' => '100 Mb'],
                ]
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'photo__limit',
                'label'  => 'photo_form_permission.photo_limit',
                'note'   => 'photo_form_permission.photo_limit_note',
                'value'  => '1000',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'photo__multiple_photo_limit',
                'label'  => 'photo_form_permission.multiple_photo_limit',
                'note'   => 'photo_form_permission.multiple_photo_limit_note',
                'value'  => '25',
            ]);

    }
}