<?php
namespace Core\Form\RuleSetting;

/**
 * Class RuleSettingString
 *
 * @package Core\Form\RuleSetting
 */
class RuleSettingString extends RuleSettingBase
{

    protected function init()
    {
        parent::init();

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'maxLength',
            'label'    => 'rule_setting.maxlength_label',
            'note'     => 'rule_setting.maxlength_note',
            'required' => false,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'minLength',
            'label'    => 'rule_setting.minlength_label',
            'note'     => 'rule_setting.minlength_note',
            'required' => false,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin' => 'section',
            'label'  => 'core.others',
            'note'   => '',
        ]);
        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'minValue',
            'label'    => 'rule_setting.minvalue_label',
            'note'     => 'rule_setting.minvalue_note',
            'required' => false,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'maxValue',
            'label'    => 'rule_setting.maxvalue_label',
            'note'     => 'rule_setting.maxvalue_note',
            'required' => false,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'contain_string',
            'label'    => 'rule_setting.contain_string_label',
            'note'     => 'rule_setting.contain_string_note',
            'required' => false,
            'class'    => 'form-control',
        ]);


        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'contain_value',
            'label'    => 'rule_setting.contain_value_label',
            'note'     => 'rule_setting.contain_value_note',
            'required' => false,
            'class'    => 'form-control',
        ]);
    }
}