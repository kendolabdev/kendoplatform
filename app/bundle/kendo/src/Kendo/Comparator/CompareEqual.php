<?php
namespace Kendo\Comparator;

/**
 * Class CompareEquals
 *
 * @package Kendo\Comparator
 */
class CompareEquals implements ComparatorInterface
{
    /**
     * @param $value
     * @param $params
     *
     * @return bool
     */
    public function isValid($value, $params)
    {
        return $value == $params;
    }
}