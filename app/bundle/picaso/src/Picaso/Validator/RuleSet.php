<?php
namespace Picaso\Validator;

/**
 * Class RuleSet
 *
 * @package Picaso\Validator
 */
class RuleSet implements ValidateInterface
{

    /**
     * @var array
     */
    private $rules = [];

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var array
     */
    private $message = [];

    /**
     * @param array $array [type: string => options : arrray]
     */
    public function __construct($array)
    {
        foreach ($array as $name => $params) {
            $this->rules[] = \App::validator()->build($name, $params);
        }
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function isValid($value)
    {
        $this->setValue($value);

        return $this->validate();
    }

    /**
     * @return true
     */
    public function validate()
    {
        $isValid = true;
        foreach ($this->rules as $rule) {
            if (!$rule instanceof ValidateInterface) {
                continue;
            }
            if (!$rule->isValid($this->value)) {
                $isValid = false;
                $this->addMesage($rule->getMessage());
            }
        }

        return $isValid;
    }

    /**
     * @param string $message
     */
    public function addMesage($message)
    {
        $this->message[] = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}