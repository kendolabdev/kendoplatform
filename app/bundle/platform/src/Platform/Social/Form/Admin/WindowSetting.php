<?php
namespace Platform\Social\Form\Admin;

use Platform\Setting\Form\Admin\BaseSettingForm;


/**
 * Class WindowSetting
 *
 * @package Social\Form\Admin
 */
class WindowSetting extends BaseSettingForm
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('window_setting.form_title');

        $this->setNote('window_setting.form_note');

        $this->addElement([
            'name'     => 'window__app_name',
            'label'    => 'window_setting.app_name',
            'note'     => 'window_setting.app_name_note',
            'required' => true,
            'class'    => 'form-control'
        ]);

        $this->addElement([
            'name'     => 'window__client_id',
            'label'    => 'window_setting.client_id',
            'note'     => 'window_setting.client_id_note',
            'required' => true,
            'class'    => 'form-control'
        ]);

        $this->addElement([
            'name'     => 'window__client_secret',
            'label'    => 'window_setting.client_secret',
            'note'     => 'window_setting.client_secret_note',
            'required' => true,
            'class'    => 'form-control'
        ]);
    }

}