<?php
namespace Base\Page\Form\Admin;

use Platform\Acl\Form\Admin\BasePermission;
use Platform\Relation\Model\RelationType;

/**
 * Class PagePermission
 *
 * @package Page\Form\Admin
 */
class PagePermission extends BasePermission
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('page_form_permission.form_title');
        $this->setNote('page_form_permission.form_note');

        $role = $this->getRole();

        \App::hookService()
            ->notify('onBeforeInitPagePermissionForm', $this);

        /**
         * Privacy options
         */
        if (!$role->isGuest() && $role->getModuleName() == 'page') {
            $relationTypes = \App::relationService()->getAllSystemRelationType('page');

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
                'name'    => 'page__privacy_option',
                'label'   => 'page_form_permission.privacy_option',
                'note'    => 'page_form_permission.privacy_option_note',
                'options' => $privacyOptions,
                'value'   => $privacyValues,
            ]);
        }

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'page__page_tab_view',
            'label'  => 'page_form_permission.page_tab_view',
            'note'   => 'page_form_permission.page_tab_view_note',
            'value'  => '1',
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'page__page_tab_exists',
                'label'  => 'page_form_permission.page_tab_exists',
                'note'   => 'page_form_permission.page_tab_exists_note',
                'value'  => '1',
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'page__create',
                'label'  => 'page_form_permission.page_create',
                'note'   => 'page_form_permission.page_create_note',
                'value'  => '1',
            ]);


        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'page__view',
            'label'  => 'page_form_permission.page_view',
            'note'   => 'page_form_permission.page_view_note',
            'value'  => '1',
        ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'yesno',
                'name'   => 'page__edit',
                'label'  => 'page_form_permission.page_edit',
                'note'   => 'page_form_permission.page_edit_note',
                'value'  => '1',
            ]);
        if (!$role->isGuest())
            $this->addElement([
                'plugin' => 'text',
                'name'   => 'page__limit',
                'label'  => 'page_form_permission.page_limit',
                'note'   => 'page_form_permission.page_limit_note',
                'value'  => 20,
            ]);

        \App::hookService()
            ->notify('onAfterInitPagePermissionForm', $this);
    }
}