<?php
namespace Platform\Core\Form\RuleSetting;

use Kendo\Html\Form;

/**
 * Class RuleSettingBase
 *
 * @package Core\Form\RuleSetting
 */
class RuleSettingBase extends Form
{

    /**
     * @var \Platform\Core\Model\ProcessRule
     */
    protected $rule;

    protected function init()
    {
        parent::init();

        $rule = $this->getRule();
        $this->setTitle($rule->getTitle());
        $this->setNote($rule->getDescription());
    }

    /**
     * @return \Platform\Core\Model\ProcessRule
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param \Platform\Core\Model\ProcessRule $rule
     */
    public function setRule($rule)
    {
        $this->rule = $rule;
    }


}