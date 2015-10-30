<?php
namespace Picaso\Validator;

/**
 * Class RuleRegexp
 *
 * @package Picaso\Validator
 */
class RuleRegexp extends Rule
{

    /**
     * @var string
     */
    protected $message = 'core.rule_regexp_invalid';

    /**
     * @var string
     */
    protected $exp;

    /**
     * @return string
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * @param string $exp
     */
    public function setExp($exp)
    {
        $this->exp = $exp;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        if (null == $this->exp) {
            return true;
        }

        if (!preg_match($this->exp, $this->getValue(), $mached)) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return \App::text($this->message, ['$value' => $this->getValue()]);
    }
}