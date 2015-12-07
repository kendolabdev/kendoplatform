<?php
namespace Event\Form\Admin;

use Kendo\Html\Form;

/**
 * Class Privacy
 *
 * @package HookEvent\Form\Admin
 */
class Privacy extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->addElements([
            [
                'plugin'  => 'multicheckbox',
                'name'    => 'privacy',
                'label'   => 'Privacy Options',
                'note'    => 'Allows members configure privacy when post data on this content',
                'options' => [
                    [
                        'value' => RELATION_TYPE_ANYONE, 'label' => \App::text('core.public'),
                    ],
                    [
                        'value' => RELATION_TYPE_REGISTERED, 'label' => \App::text('core.registered_member'),
                    ],
                    [
                        'value' => RELATION_TYPE_MEMBER, 'label' => \App::text('event.event_member'),
                    ],
                    [
                        'value' => RELATION_TYPE_EDITOR, 'label' => \App::text('event.event_editor'),
                    ],
                    [
                        'value' => RELATION_TYPE_ADMIN, 'label' => \App::text('event.event_admin'),
                    ],
                    [
                        'value' => RELATION_TYPE_OWNER, 'label' => \App::text('event.event_owner'),
                    ],
                ],
            ],
            [
                'plugin' => 'submit',
                'label'  => \App::text('core.save_changes'),
                'class'  => 'btn btn-primary'
            ]
        ]);
    }

}