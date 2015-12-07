<?php

namespace Blog\Form;


use Kendo\Html\Form;

/**
 * Class EditPost
 *
 * @package Blog\Form
 */
class DeletePost extends Form
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('blog.delete_form_title');

        $this->setNote('blog.delete_form_note');

        $this->addElement([
            'plugin'   => 'static',
            'name'     => 'title',
            'required' => true,
            'class'    => 'form-control'
        ]);

        $this->addElement([
            'plugin'   => 'submit',
            'label'    => 'core.delete',
            'required' => 1,
            'class'    => 'btn btn-primary'
        ]);
    }
}