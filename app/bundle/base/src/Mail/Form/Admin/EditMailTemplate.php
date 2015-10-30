<?php

namespace Mail\Form\Admin;

use Picaso\Html\Form;

/**
 * Class EditMailTemplate
 *
 * @package Mail\Form\Admin
 */
class EditMailTemplate extends Form
{
    /**
     * Override init method
     */
    protected function init()
    {
        $this->setTitle('core_form_mail_template.form_title');

        $this->addElements([
            [
                'plugin' => 'static',
                'name'   => 'mail_name',
                'label'  => 'core_form_mail_template.code_label',
                'note'   => 'core_form_mail_template.code_note',
                'value'  => 'user_register_welcome',
            ],
            [
                'plugin'   => 'text',
                'name'     => 'subject',
                'label'    => 'core_form_mail_template.subject_label',
                'note'     => 'core_form_mail_template.subject_note',
                'required' => true,
                'class'    => 'form-control',
            ],
            [
                'plugin' => 'static',
                'name'   => 'placeholder',
                'label'  => 'core_form_mail_template.placeholder_label',
                'note'   => 'core_form_mail_template.placeholder_note',
                'value'  => '[host], [site_name]',
            ],
            [
                'plugin'      => 'textarea',
                'name'        => 'body_html',
                'label'       => 'core_form_mail_template.body_html_label',
                'note'        => 'core_form_mail_template.body_html_note',
                'required'    => 1,
                'placeholder' => 1,
                'rows'        => 10,
                'class'       => 'form-control',
            ],
            [
                'plugin'      => 'textarea',
                'name'        => 'body_text',
                'label'       => 'core_form_mail_template.body_text_label',
                'note'        => 'core_form_mail_template.body_text_note',
                'required'    => 1,
                'placeholder' => 1,
                'rows'        => 10,
                'class'       => 'form-control',
            ],
            [
                'plugin' => 'checkbox',
                'name'   => 'save_default',
                'label'  => 'core_form_mail_template.save_template_label',
                'note'   => 'core_form_mail_template.save_template_note'
            ],

        ]);

    }
}