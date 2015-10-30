<?php
namespace Picaso\Validator;

/**
 * Interface ValidateInterface
 *
 * @package Picaso\Validator
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