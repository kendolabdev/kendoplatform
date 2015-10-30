<?php

namespace Help\Form\Admin;

use Picaso\Html\Form;

/**
 * Class CreateHelpPost
 *
 * @package Help\Form\Admin
 */
class CreateHelpPost extends Form
{

    protected function init()
    {
        $this->setTitle('Create New Post');

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'topic_id',
            'label'    => 'Topic',
            'class'    => 'form-control',
            'required' => true,
            'options'  => \App::help()->loadAdminTopicOptions(),
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'post_title',
            'label'    => 'Title',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'textarea',
            'name'     => 'post_description',
            'label'    => 'Description',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'textarea',
            'name'     => 'post_content',
            'label'    => 'Content',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'yesno',
            'name'     => 'post_active',
            'required' => true,
            'class'    => 'form-control',
            'value'    => '1',
        ]);
    }
}