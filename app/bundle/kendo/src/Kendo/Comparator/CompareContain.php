<?php
namespace Kendo\Comparator;

/**
 * Class CompareContain
 *
 * @package Kendo\Comparator
 */
class CompareContain implements ComparatorInterface
{

    /**
     * @param $value
     * @param $params
     *
     * @return bool
     */
    public function isValid($value, $params)
    {
        if (is_string($params)) {
            return strpos($params, $value) !== false;
        } else if (is_array($params)) {
            return in_array($value, $params);
        }

        return false;
    }
}