<?php
namespace Event\Form\Admin;

use Acl\Form\Admin\BasePermission;
use Core\Model\RelationType;

/**
 * Class EventPermission
 *
 * @package Event\Form\Admin
 */
class EventPermission extends BasePermission
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('event_form_permission.form_title');
        $this->setNote('event_form_permission.form_note');

        $role = $this->getRole();

        \App::hook()
            ->notify('onBeforeInitEventPermissionForm', $this);


        /**
         * Add privacy options fields
         */
        if (!$role->isGuest() && $role->getModuleName() == 'event') {
            $relationTypes = \App::relationService()->getAllSystemRelationType('event');

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
                'name'    => 'event__privacy_option',
                'label'   => 'event_form_permission.privacy_option',
                'note'    => 'event_form_permission.privacy_option_note',
                'options' => $privacyOptions,
                'value'   => $privacyValues,
            ]);
        }

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'event__event_tab_view',
            'label'  => 'event_form_permission.event_tab_view',
            'note'   => 'event_form_permission.event_tab_view_note',
            'value'  => '1',
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'event__event_tab_exists',
                'label'  => 'event_form_permission.event_tab_exists',
                'note'   => 'event_form_permission.event_tab_exists_note',
                'value'  => '1',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'event__create',
                'label'  => 'event_form_permission.event_create',
                'note'   => 'event_form_permission.event_create_note',
                'value'  => '1',
            ]);


        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'event__view',
            'label'  => 'event_form_permission.event_view',
            'note'   => 'event_form_permission.event_view_note',
            'value'  => '1',
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'event__edit',
                'label'  => 'event_form_permission.event_edit',
                'note'   => 'event_form_permission.event_edit_note',
                'value'  => '1',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'event__delete',
                'label'  => 'event_form_permission.event_delete',
                'note'   => 'event_form_permission.event_delete_note',
                'value'  => '1',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'event__limit',
                'label'  => 'event_form_permission.event_limit',
                'note'   => 'event_form_permission.event_limit_note',
                'value'  => '10',
            ]);

        \App::hook()
            ->notify('onAfterInitEventPermissionForm', $this);
    }

}