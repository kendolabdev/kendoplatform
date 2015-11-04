<?php

namespace Picaso\Html;

/**
 * Class FormField
 *
 * @package Picaso\Html
 */
interface FormField
{
    /**
     * In order to support attribute field
     *
     * @return int
     */
    public function getFieldId();

    /**
     * In order to support attribute form
     *
     * @param $fieldId
     */
    public function setFieldId($fieldId);

    /**
     * @return
     */
    public function getValue();

    /**
     * @param $value
     */
    public function setValue($value);

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isValid($value);

    /**
     * @return true
     */
    public function isDisabled();
}