<?php
namespace Picaso\Validator;

/**
 * Class Rule
 *
 * @package Picaso\Validator
 */
abstract class Rule implements ValidateInterface
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $message = 'Invalid';

    /**
     * @param array $options
     */
    public function __construct($options = [])
    {
        foreach ($options as $name => $value) {
            if (method_exists($this, $method = 'set' . ucfirst($name))) {
                $this->{$method}($value);
            }
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
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
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
     * @return bool
     */
    abstract public function validate();
}