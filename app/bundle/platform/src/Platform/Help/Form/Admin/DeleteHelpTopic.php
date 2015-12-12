<?php

namespace Platform\Help\Form\Admin;

use Kendo\Html\Form;

/**
 * Class DeleteHelpTopic
 *
 * @package Help\Form\Admin
 */
class DeleteHelpTopic extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Delete Topic');
        $this->setNote('Delete help topic');


        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'topic_title',
            'label'    => 'Topic Name',
            'class'    => 'form-control',
            'required' => true,
        ]);
    }
}