<?php
namespace Picaso\Comparator;

/**
 * Class CompareEquals
 *
 * @package Picaso\Comparator
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