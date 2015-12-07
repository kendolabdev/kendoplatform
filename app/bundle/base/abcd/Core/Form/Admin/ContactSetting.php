<?php

namespace Core\Form\Admin;

use Setting\Form\Admin\BaseSettingForm;

/**
 * Class ContactSetting
 *
 * @package Core\Form\Admin
 */
class ContactSetting extends BaseSettingForm
{

    /**
     *
     */
    protected function init()
    {

        $this->setTitle('contact_setting.form_title');
        $this->setNote('contact_setting.form_note');

        $this->addElement([
            'name'  => 'contact__address_line_1',
            'label' => 'contact_setting.address_line_1',
            'note'  => 'contact_setting.address_line_1_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__address_line_2',
            'label' => 'contact_setting.address_line_2',
            'note'  => 'contact_setting.address_line_2_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__address_line_3',
            'label' => 'contact_setting.address_line_3',
            'note'  => 'contact_setting.address_line_3_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__email',
            'label' => 'contact_setting.email',
            'note'  => 'contact_setting.email_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__website',
            'label' => 'contact_setting.website',
            'note'  => 'contact_setting.website_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__fax',
            'label' => 'contact_setting.fax',
            'note'  => 'contact_setting.fax_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__phone',
            'label' => 'contact_setting.phone',
            'note'  => 'contact_setting.phone_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__facebook',
            'label' => 'contact_setting.facebook',
            'note'  => 'contact_setting.facebook_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__twitter',
            'label' => 'contact_setting.twitter',
            'note'  => 'contact_setting.twitter_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__google',
            'label' => 'contact_setting.google',
            'note'  => 'contact_setting.google_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__linkedin',
            'label' => 'contact_setting.linkedin',
            'note'  => 'contact_setting.linkedin_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__instagram',
            'label' => 'contact_setting.instagram',
            'note'  => 'contact_setting.instagram_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__pinterest',
            'label' => 'contact_setting.pinterest',
            'note'  => 'contact_setting.pinterest_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__youtube',
            'label' => 'contact_setting.youtube',
            'note'  => 'contact_setting.youtube_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__skype',
            'label' => 'contact_setting.skype',
            'note'  => 'contact_setting.skype_note',
            'class' => 'form-control',
        ]);

        $this->addElement([
            'name'  => 'contact__msn',
            'label' => 'contact_setting.msn',
            'note'  => 'contact_setting.msn_note',
            'class' => 'form-control',
        ]);
    }
}