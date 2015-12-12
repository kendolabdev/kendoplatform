<?php

namespace Platform\Help\Form\Admin;

use Kendo\Html\Form;

/**
 * Class DeleteHelpPost
 *
 * @package Help\Form\Admin
 */
class DeleteHelpPost extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Delete Post');
        $this->setNote('Delete post');


        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'post_title',
            'label'    => 'Post Title',
            'class'    => 'form-control',
            'required' => true,
        ]);
    }
}