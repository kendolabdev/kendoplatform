<?php
namespace Platform\Core\Form\Admin;

use Platform\Acl\Form\Admin\BasePermission;


/**
 * Class CorePermission
 *
 * @package Core\Form\Admin
 */
class CorePermission extends BasePermission
{
    protected function init()
    {
        $this->setTitle('core_form_permission.form_title');
        $this->setNote('core_form_permission.form_note');

        $role = $this->getRole();

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'radio',
                'name'     => 'core__storage_limit',
                'label'    => 'core_form_permission.storage_limit',
                'note'     => 'core_form_permission.storage_limit_note',
                'required' => true,
                'value'    => '52428800',
                'options'  => [
                    ['value' => '5242880', 'label' => '5 Mb'], // 5mb
                    ['value' => '26214400', 'label' => '25 Mb'], // 25mb
                    ['value' => '52428800', 'label' => '50 Mb'], //50mb
                    ['value' => '104857600', 'label' => '100 Mb'], // 100mb
                    ['value' => '1073741824', 'label' => '1 Gb'], // 1 Gb
                    ['value' => '10737418240', 'label' => '10 Gb'], // 10 Gb
                ],
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'core__block_other',
                'label'    => 'core_form_permission.block_other',
                'note'     => 'core_form_permission.block_other_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'core__report',
                'label'    => 'core_form_permission.report',
                'note'     => 'core_form_permission.report_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'message__chat',
                'label'    => 'core_form_permission.chat_label',
                'note'     => 'core_form_permission.chat_note',
                'required' => true,
                'value'    => 1,
            ]);

    }
}