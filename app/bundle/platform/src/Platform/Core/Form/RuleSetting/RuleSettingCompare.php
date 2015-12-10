<?php
namespace Platform\Core\Form\RuleSetting;

/**
 * Class RuleSettingCompare
 *
 * @package Core\Form\RuleSetting
 */
class RuleSettingCompare extends RuleSettingBase
{
    protected function init()
    {
        parent::init();

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
            'name'     => 'equalValue',
            'label'    => 'rule_setting.equal_label',
            'note'     => 'rule_setting.equal_note',
            'required' => false,
            'class'    => 'form-control',
        ]);
    }
}