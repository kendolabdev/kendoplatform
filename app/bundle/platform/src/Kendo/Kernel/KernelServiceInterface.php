<?php
namespace Kendo\Kernel;

/**
 * Interface ServiceInterface
 *
 * @package Kendo\Kernel
 */
interface KernelServiceInterface
{
    /**
     * ServiceInterface constructor.
     *
     * @param Application $app
     *
     * @return mixed
     */
    public function bind(Application $app);

    /**
     * Invoke by application to start a service
     */
    public function bound();
}