<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Kendo
 */

namespace Kendo\Registry;
use Kendo\Kernel\KernelServiceAgreement;

/**
 * Class Manager
 *
 * @package Kendo
 */
class Manager extends KernelServiceAgreement
{
    /**
     * @var array
     */
    private $vars = [];

    /**
     * @param string $key
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function get($key, $defaultValue = null)
    {
        return isset($this->vars[ $key ]) ? $this->vars[ $key ] : $defaultValue;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @return void
     */
    public function set($key, $value)
    {
        $this->vars[ $key ] = $value;
    }
}
