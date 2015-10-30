<?php

namespace Core\Form\RuleSetting;

use Picaso\Html\Form;

/**
 * Class AddRule
 *
 * @package Core\Form\RuleSetting
 */
class AddRule extends Form
{

    /**
     * init rule
     */
    protected function init()
    {
        $this->setTitle('rule_setting.form_add_title');
        $this->setNote('rule_setting.form_add_note');

        $this->addElement([
            'plugin'        => 'multicheckbox',
            'name'          => 'rule_name',
            'value'         => 'compare',
            'label'         => 'rule_setting.rule_name_label',
            'note'          => 'rule_setting.rule_name_note',
            'optionTextKey' => 1,
        ]);
    }
}