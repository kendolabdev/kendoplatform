<?php
namespace Base\Message\Form;

use Kendo\Html\Form;

/**
 * Class ComposeMessage
 *
 * @package Message\Form
 */
class ComposeMessage extends Form
{
    protected function init()
    {
        parent::init();

        $this->setTitle('message_compose.form_title');
        $this->setNote('message_compose.form_note');

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'send',
        ]);

        $this->addElement([
            'plugin'      => 'suggest',
            'name'        => 'recipients',
            'label'       => 'compose_message.recipient_label',
            'placeholder' => 'compose_message.recipient_placeholder',
            'note'        => 'compose_message.recipient_note',
            'multiple'    => true,
            'class'       => 'form-control',

        ]);

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'subject',
            'maxlength'   => 200,
            'label'       => 'compose_message.subject_label',
            'placeholder' => 'compose_message.subject_placeholder',
            'note'        => 'compose_message.subject_note',
            'required'    => true,
            'class'       => 'form-control',
        ]);

        $this->addElement([
            'plugin'      => 'textarea',
            'name'        => 'content',
            'label'       => 'compose_message.content_label',
            'placeholder' => 'compose_message.content_placeholder',
            'note'        => 'compose_message.content_note',
            'required'    => true,
            'class'       => 'form-control',
        ]);

    }
}