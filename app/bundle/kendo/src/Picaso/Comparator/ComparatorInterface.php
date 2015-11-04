<?php
namespace Picaso\Comparator;

/**
 * Interface ComparatorInterface
 *
 * @package Picaso\Process
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