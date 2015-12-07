<?php
namespace Kendo\Comparator;

/**
 * Interface ComparatorInterface
 *
 * @package Kendo\Process
 */
interface ComparatorInterface
{

    /**
     * @param $value
     * @param $params
     *
     * @return bool
     */
    public function isValid($value, $params);
}