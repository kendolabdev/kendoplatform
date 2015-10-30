<?php

namespace User\Form\Admin;

use Acl\Form\Admin\BasePermission;
use Core\Model\RelationType;


/**
 * Class UserPermission
 *
 * @package User\Form\Admin
 */
class UserPermission extends BasePermission
{
    /**
     * Callback at ended constructor.
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('user_form_permission.form_title');
        $this->setNote('user_form_permission.form_note');

        $role = $this->getRole();

        \App::hook()
            ->notify('onBeforeInitUserPermissionForm', $this);

        /**
         * Add privacy options
         */
        if (!$role->isGuest() && $role->getModuleName() == 'user') {
            $relationTypes = \App::relation()->getAllSystemRelationType('user');

            $privacyOptions = [
                ['value' => RELATION_TYPE_ANYONE, 'label' => \App::text('core.public'),],
                ['value' => RELATION_TYPE_REGISTERED, 'label' => \App::text('core.registered')],
            ];

            foreach ($relationTypes as $type) {
                if (!$type instanceof RelationType) continue;
                $privacyOptions[] = ['value' => $type->getRelationType(), 'label' => $type->getDescription()];
            }

            $privacyOptions[] = ['value' => RELATION_TYPE_MEMBER_OF_MEMBER, 'label' => 'Friends of Friends'];

            $privacyOptions[] = ['value' => RELATION_TYPE_CUSTOM, 'label' => 'Custom List'];

            $privacyValues = [];

            foreach ($privacyOptions as $option) {
                $privacyValues[] = $option['value'];
            }


            $this->addElement([
                'plugin'  => 'multicheckbox',
                'name'    => 'user__privacy_option',
                'label'   => 'user_form_permission.privacy_option',
                'note'    => 'user_form_permission.privacy_option_note',
                'options' => $privacyOptions,
                'value'   => $privacyValues,
            ]);
        }

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'user__invite_guest',
                'label'    => 'user_form_permission.invite_guest',
                'note'     => 'user_form_permission.invite_guest_note',
                'required' => true,
                'value'    => 1,
            ]);

        $this->addElement([
            'plugin'   => 'yesno',
            'name'     => 'user__friend_tab_view',
            'label'    => 'user_form_permission.friend_tab_view',
            'note'     => 'user_form_permission.friend_tab_view_note',
            'required' => true,
            'value'    => 1,
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'user__friend_tab_exists',
                'label'    => 'user_form_permission.friend_tab_exists',
                'note'     => 'user_form_permission.friend_tab_exists_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'user__friend_request',
                'label'    => 'user_form_permission.friend_request',
                'note'     => 'user_form_permission.friend_request_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'user__friend_list_create',
                'label'    => 'user_form_permission.friend_list_create',
                'note'     => 'user_form_permission.friend_list_create_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'user__friend_list_limit',
                'label'    => 'user_form_permission.friend_list_limit',
                'note'     => 'user_form_permission.friend_list_limit_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'user__profile_name_edit',
                'label'    => 'user_form_permission.profile_name_edit',
                'note'     => 'user_form_permission.profile_name_edit_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'text',
                'name'     => 'user__profile_name_edit_limit',
                'label'    => 'user_form_permission.profile_name_edit_limit',
                'note'     => 'user_form_permission.profile_name_edit_limit_note',
                'required' => true,
                'value'    => 5,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'user__email_edit',
                'label'    => 'user_form_permission.email_edit',
                'note'     => 'user_form_permission.email_edit_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'text',
                'name'     => 'user__email_edit_limit',
                'label'    => 'user_form_permission.email_edit_limit',
                'note'     => 'user_form_permission.email_edit_limit_note',
                'required' => true,
                'value'    => 5,
            ]);

        \App::hook()
            ->notify('onAfterInitUserPermissionForm', $this);
    }
}