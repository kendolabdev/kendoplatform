<?php
namespace Group\Form\Admin;

use Acl\Form\Admin\BasePermission;
use Core\Model\RelationType;

/**
 * Class GroupPermission
 *
 * @package Group\Form\Admin
 */
class GroupPermission extends BasePermission
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('group_form_permission.form_title');
        $this->setNote('group_form_permission.form_note');

        $role = $this->getRole();

        \App::hook()
            ->notify('onBeforeInitGroupPermissionForm', $this);

        /**
         * Add privacy options
         */
        if (!$role->isGuest() && $role->getModuleName() == 'group') {
            $relationTypes = \App::relationService()->getAllSystemRelationType('group');

            $privacyOptions = [
                ['value' => RELATION_TYPE_ANYONE, 'label' => \App::text('core.public'),],
                ['value' => RELATION_TYPE_REGISTERED, 'label' => \App::text('core.registered')],
            ];

            foreach ($relationTypes as $type) {
                if (!$type instanceof RelationType) continue;
                $privacyOptions[] = ['value' => $type->getRelationType(), 'label' => $type->getDescription()];
            }

            $privacyValues = [];

            foreach ($privacyOptions as $option) {
                $privacyValues[] = $option['value'];
            }


            $this->addElement([
                'plugin'  => 'multicheckbox',
                'name'    => 'group__privacy_option',
                'label'   => 'group_form_permission.privacy_option',
                'note'    => 'group_form_permission.privacy_option_note',
                'options' => $privacyOptions,
                'value'   => $privacyValues,
            ]);
        }

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'group__group_tab_view',
            'label'  => 'group_form_permission.group_tab_view',
            'note'   => 'group_form_permission.group_tab_view_note',
            'value'  => '1',
        ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'group__group_tab_exists',
                'label'  => 'group_form_permission.group_tab_exists',
                'note'   => 'group_form_permission.group_tab_exists_note',
                'value'  => '1',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'group__create',
                'label'  => 'group_form_permission.group_create',
                'note'   => 'group_form_permission.group_create_note',
                'value'  => '1',
            ]);


        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'group__view',
            'label'  => 'group_form_permission.group_view',
            'note'   => 'group_form_permission.group_view_note',
            'value'  => '1',
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'group__edit',
                'label'  => 'group_form_permission.group_edit',
                'note'   => 'group_form_permission.group_edit_note',
                'value'  => '1',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'group__delete',
                'label'  => 'group_form_permission.group_delete',
                'note'   => 'group_form_permission.group_delete_note',
                'value'  => '1',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'group__limit',
                'label'  => 'group_form_permission.group_limit',
                'note'   => 'group_form_permission.group_limit_note',
                'value'  => '10',
            ]);

        \App::hook()
            ->notify('onAfterInitGroupPermissionForm', $this);
    }
}