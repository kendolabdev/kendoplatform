<?php
namespace Platform\Event\Form\Admin;

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
                        'value' => RELATION_TYPE_ANYONE, 'label' => app()->text('core.public'),
                    ],
                    [
                        'value' => RELATION_TYPE_REGISTERED, 'label' => app()->text('core.registered_member'),
                    ],
                    [
                        'value' => RELATION_TYPE_MEMBER, 'label' => app()->text('event.event_member'),
                    ],
                    [
                        'value' => RELATION_TYPE_EDITOR, 'label' => app()->text('event.event_editor'),
                    ],
                    [
                        'value' => RELATION_TYPE_ADMIN, 'label' => app()->text('event.event_admin'),
                    ],
                    [
                        'value' => RELATION_TYPE_OWNER, 'label' => app()->text('event.event_owner'),
                    ],
                ],
            ],
            [
                'plugin' => 'submit',
                'label'  => app()->text('core.save_changes'),
                'class'  => 'btn btn-primary'
            ]
        ]);
    }

}