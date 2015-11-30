<?php

namespace Blog\Form;


use Picaso\Html\Form;

/**
 * Class AddPost
 *
 * @package Blog\Form
 */
class AddPost extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('blog_form.add_blog_post');

        $this->setNote('blog_form.add_blog_note');

        $this->addElement([
            'plugin'      => 'text',
            'name'        => 'title',
            'label'       => 'blog_form.title_label',
            'description' => 'blog_form.title_note',
            'placeholder' => 'blog_form.title_placeholder',
            'required'    => true,
            'class'       => 'form-control'
        ]);
        $this->addElement([
            'plugin'      => 'textarea',
            'name'        => 'description',
            'label'       => 'blog_form.description_label',
            'note'        => 'blog_form.description_note',
            'placeholder' => 'blog_form.description_placeholder',
            'required'    => 1,
            'class'       => 'form-control'
        ]);

        $this->addElement([
            'plugin'      => 'textarea',
            'name'        => 'content',
            'htmlEditor'  => true,
            'label'       => 'blog_form.content_label',
            'note'        => 'blog_form.content_note',
            'placeholder' => 'blog_form.content_placeholder',
            'required'    => 1,
            'class'       => 'form-control'
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'is_published',
            'label'         => 'blog_form.status_label',
            'note'          => 'blog_form.status_note',
            'optionTextKey' => 1,
            'options'       => [
                ['value' => '0', 'label' => 'blog_form.save_as_draft'],
                ['value' => '1', 'label' => 'blog_form.yes'],
            ],
            'value'         => '0',
        ]);

        $this->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'blog__view',
            'label'     => 'blog_form.privacy_view_label',
            'forAction' => 'blog__view',
        ]);

        $this->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'activity__comment',
            'label'     => 'blog_form.privacy_comment_label',
            'forAction' => 'activity__comment',
        ]);
    }
}