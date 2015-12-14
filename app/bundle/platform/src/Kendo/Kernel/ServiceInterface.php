<?php
namespace Kendo\Kernel;

/**
 * Interface ServiceInterface
 *
 * @package Kendo\Kernel
 */
interface ServiceInterface
{
    /**
     * ServiceInterface constructor.
     *
     * @param Application $app
     */
    public function bind(Application $app);

    /**
     * @return array
     */
    public function alias();

    /**
     * Invoke by application to start a service
     */
    public function bound();
}