<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Picaso
 */

namespace Picaso\Registry;

/**
 * Class Manager
 *
 * @package Picaso
 */
class Manager
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

    /**
     * @param array $pairs array (key=>value)
     *
     * @return void
     */
    public function setAll(array $pairs)
    {
        foreach ($pairs as $key => $value) {
            $this->vars[ $key ] = $value;
        }
    }
}
