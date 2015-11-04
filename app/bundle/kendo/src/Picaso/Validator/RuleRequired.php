<?php
namespace Picaso\Validator;

/**
 * Class RuleRequired
 *
 * @package Picaso\Validator
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