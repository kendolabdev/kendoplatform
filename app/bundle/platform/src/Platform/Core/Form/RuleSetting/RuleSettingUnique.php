<?php
namespace Platform\Core\Form\RuleSetting;

/**
 * Class RuleSettingUnique
 *
 * @package Core\Form\RuleSetting
 */
class RuleSettingUnique extends RuleSettingBase
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'tableName',
            'label'    => 'rule_setting.tablename_label',
            'note'     => 'rule_setting.tablename_note',
            'required' => false,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'columnName',
            'label'    => 'rule_setting.columnname_label',
            'note'     => 'rule_setting.columnname_note',
            'required' => false,
            'class'    => 'form-control',
        ]);
    }
}