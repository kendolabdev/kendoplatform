<?php

namespace Blog\Form;


/**
 * Class EditPost
 *
 * @package Blog\Form
 */
class EditPost extends AddPost
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('blog_form.edit_blog_post');
        $this->setNote('blog_form.edit_blog_note');
    }
}