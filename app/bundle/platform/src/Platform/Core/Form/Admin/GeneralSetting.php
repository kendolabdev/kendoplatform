<?php

namespace Platform\Core\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;


/**
 * Class GeneralSetting
 *
 * @package Core\Form\Admin
 */
class GeneralSetting extends BaseSettingForm
{

    /**
     *
     */
    protected function init()
    {

        $this->setTitle('core_general_setting.form_title');
        $this->setNote('core_general_setting.form_note');

        $this->addElement([
            'plugin'   => 'radio',
            'name'     => 'core__network_mode',
            'label'    => 'core_general_setting.network_mode',
            'note'     => 'core_general_setting.network_mode_label',
            'required' => true,
            'value'    => '0',
            'options'  => [
                ['value' => '0', 'label' => 'Public mode, guest can browse network.'],
                ['value' => '1', 'label' => 'Private mode, guest can not browse network unless static help, login & register pages.']
            ]
        ]);

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'core__maintenance',
            'label'         => 'core_general_setting.offline_mode',
            'note'          => 'core_general_setting.offline_mode_note',
            'optionTextKey' => 'core_general_setting.offline_mode_opt_',
            'options'       => [
                ['value' => '0'],
                ['value' => '1'],
            ],
            'value'         => '1',
        ]);

        $this->addElement([
            'name'  => 'core__maintenance_code',
            'label' => 'core_general_setting.maintenance_code',
            'note'  => 'core_general_setting.maintenance_code_note',
            'class' => 'form-control',
            'value' => '',
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'core__static_base_url',
            'label'  => 'core_general_setting.static_url',
            'note'   => 'core_general_setting.static_url_note',
            'class'  => 'form-control',
            'value'  => KENDO_BASE_URL,
            'rules'  => [
                'required' => ['message' => 'core_general_setting.static_url_required'],
            ],
        ]);

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'core__cookie_path',
            'label'  => 'core_general_setting.cookie_path',
            'note'   => 'core_general_setting.cookie_path_note',
            'class'  => 'form-control',
            'value'  => KENDO_BASE_URL,
        ]);

        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'core__cookie_domain',
            'label'  => 'core_general_setting.cookie_domain',
            'note'   => 'core_general_setting.cookie_domain_note',
            'class'  => 'form-control',
            'value'  => '',
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'required' => true,
            'name'     => 'core__cookie_lifetime',
            'label'    => 'core_general_setting.cookie_lifetime',
            'note'     => 'core_general_setting.cookie_lifetime',
            'class'    => 'form-control',
            'options'  => [
                ['value' => '86400', 'label' => '1 day'],
            ],
            'value'    => '86400',
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'core__timezone_default',
            'label'  => 'core_general_setting.timezone_default',
            'note'   => 'core_general_setting.timezone_default_note',
            'class'  => 'form-control',
            'value'  => '',
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'core__google_analytics',
            'label'  => 'core_general_setting.google_analytics',
            'note'   => 'core_general_setting.google_analytics_note',
            'class'  => 'form-control',
        ]);

        $this->addElement([
            'plugin' => 'textarea',
            'name'   => 'core__head_script',
            'label'  => 'core_general_setting.head_script',
            'note'   => 'core_general_setting.head_script_note',
            'class'  => 'form-control',
        ]);

        $this->addElement([
            'plugin' => 'textarea',
            'name'   => 'core__bottom_script',
            'label'  => 'core_general_setting.bottom_script',
            'note'   => 'core_general_setting.bottom_script_note',
            'class'  => 'form-control',
        ]);
    }

    /**
     *
     * Overwrite save method.
     * Put some default setting.
     *
     */
    public function save()
    {
        $data = $this->getData();

        if (!$data['core__static_base_url']) {
            $data['core__static_base_url'] = KENDO_BASE_URL;
        }

        if (!$data['core__maintenance_code']) {
            $data['core__maintenance_code'] = uniqid();
        }

        if (!$data['core__cookie_path']) {
            $data['core__cookie_path'] = KENDO_BASE_URL;
        }

        if (!$data['core__cookie_lifetime']) {
            $data['core__cookie_path'] = 86400; // 1 days
        }

        $_SESSION['maintenance'] = $data['core__maintenance_code'];

        $this->_save($data);
    }


}