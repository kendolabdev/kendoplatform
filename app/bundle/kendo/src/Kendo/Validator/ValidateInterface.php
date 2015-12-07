<?php
namespace Kendo\Validator;

/**
 * Interface ValidateInterface
 *
 * @package Kendo\Validator
 */
interface ValidateInterface
{
    /**
     * @param $value
     *
     * @return bool
     */
    public function isValid($value);

    /**
     * @return mixed
     */
    public function getMessage();
}