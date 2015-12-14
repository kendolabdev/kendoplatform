<?php

namespace Kendo\Hook;
use Kendo\Kernel\KernelServiceAgreement;

/**
 * Class EventHandler
 *
 * @package Kendo\Application
 */
class EventListener extends KernelServiceAgreement
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