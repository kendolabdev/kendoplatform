<?php

namespace Kendo\Hook;
use Kendo\Kernel\KernelService;

/**
 * Class EventHandler
 *
 * @package Kendo\Application
 */
class EventListener extends KernelService
{
    /**
     * @codeCoverageIgnore
     *
     * @param string $name
     * @param array  $arguments
     */
    public function __call($name, $arguments)
    {
    }
}