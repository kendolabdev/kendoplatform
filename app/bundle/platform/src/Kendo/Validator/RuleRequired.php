<?php
namespace Kendo\Validator;

/**
 * Class RuleRequired
 *
 * @package Kendo\Validator
 */
class RuleRequired extends Rule
{
    /**
     * @return bool
     */
    public function validate()
    {
        $value = $this->getValue();

        return null !== $value && '' !== $value;
    }
}