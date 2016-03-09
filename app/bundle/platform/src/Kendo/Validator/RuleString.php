<?php
namespace Kendo\Validator;

/**
 * Class RuleString
 *
 * @package Kendo\Validator
 */
class RuleString extends Rule
{
    /**
     * @var string
     */
    protected $message = 'core.rule_invalid_string';

    /**
     * @var int
     */
    protected $maxLength = 0;

    /**
     * @var int
     */
    protected $minLength = 0;

    /**
     * @var string
     */
    protected $minValue;

    /**
     * @var string
     */
    protected $maxValue;

    /**
     * @return int
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * @param int $maxLength
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    /**
     * @return int
     */
    public function getMinLength()
    {
        return $this->minLength;
    }

    /**
     * @param int $minLength
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        $value = $this->getValue();

        $length = mb_strlen($value);

        if ($this->maxLength > 0 && $length > $this->maxLength) {
            return false;
        }

        if ($this->minLength && $length < $this->minLength) {
            return false;
        }

        if ($this->minValue && $value < $this->minValue) {
            return false;
        }

        if ($this->maxValue && $value > $this->maxValue) {
            return false;
        }

        return true;
    }

    /**
     *
     */
    public function getMessage()
    {
        return app()->text($this->message, ['$value' => $this->getValue()]);
    }
}

