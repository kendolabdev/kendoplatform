<?php
namespace Picaso\Validator;

/**
 * Class RuleCompare
 *
 * @package Picaso\Validator
 */
class RuleCompare extends Rule
{
    /**
     * @var mixed
     */
    private $maxValue;

    /**
     * @var mixed
     */
    private $minValue;

    /**
     * @var string
     */
    private $equalValue;

    /**
     * @return string
     */
    public function getEqualValue()
    {
        return $this->equalValue;
    }

    /**
     * @param string $equalValue
     */
    public function setEqualValue($equalValue)
    {
        $this->equalValue = $equalValue;
    }

    /**
     * @return mixed
     */
    public function getMinValue()
    {
        return $this->minValue;
    }

    /**
     * @param mixed $minValue
     */
    public function setMinValue($minValue)
    {
        $this->minValue = $minValue;
    }

    /**
     * @return mixed
     */
    public function getMaxValue()
    {
        return $this->maxValue;
    }

    /**
     * @param mixed $maxValue
     */
    public function setMaxValue($maxValue)
    {
        $this->maxValue = $maxValue;
    }

    /**
     * @return bool
     */
    public function validate()
    {

        if ($this->maxValue !== null && $this->value > $this->maxValue) {
            return false;
        }

        if ($this->minValue !== null && $this->value < $this->minValue) {
            return false;
        }

        if ($this->equalValue !== null && $this->value != $this->equalValue) {
            return false;
        }

        return true;
    }
}