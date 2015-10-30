<?php
namespace Core\Form\RuleSetting;

/**
 * Class RuleSettingRegexp
 *
 * @package Core\Form\RuleSetting
 */
class RuleSettingRegexp extends RuleSettingBase
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'exp',
            'label'    => 'rule_setting.exp_label',
            'note'     => 'rule_setting.exp_note',
            'required' => false,
            'class'    => 'form-control',
        ]);
    }
}