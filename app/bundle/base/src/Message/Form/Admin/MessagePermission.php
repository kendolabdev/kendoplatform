<?php

namespace Message\Form\Admin;

use Acl\Form\Admin\BasePermission;


/**
 * Class UserPermission
 *
 * @package User\Form\Admin
 */
class MessagePermission extends BasePermission
{
    /**
     * Callback at ended constructor.
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('message_form_permission.form_title');
        $this->setNote('message_form_permission.form_note');

        $role = $this->getRole();

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'message__chat',
                'label'    => 'message_form_permission.chat',
                'note'     => 'message_form_permission.chat_note',
                'required' => true,
                'value'    => 1,
            ]);

        if (!$role->isGuest())
            $this->addElement([
                'plugin'   => 'yesno',
                'name'     => 'message__message',
                'label'    => 'message_form_permission.message',
                'note'     => 'message_form_permission.message_note',
                'required' => true,
                'value'    => 1,
            ]);
    }
}
