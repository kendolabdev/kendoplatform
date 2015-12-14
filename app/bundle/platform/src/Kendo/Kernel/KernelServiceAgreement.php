<?php
namespace Kendo\Kernel;

/**
 * Class ServiceAgreement
 *
 * @package Kendo\Kernel
 */
class KernelServiceAgreement implements ServiceInterface
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     */
    public function bind(Application $app)
    {
        $this->app = $app;
    }

    /**
     *
     */
    public function alias()
    {
        return [];
    }

    /**
     * Do nothing here
     */
    public function bound()
    {

    }
}