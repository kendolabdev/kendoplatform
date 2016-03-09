<?php
namespace Kendo\Kernel;

/**
 * Class ServiceAgreement
 *
 * @package Kendo\Kernel
 */
class KernelService implements KernelServiceInterface
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @return KernelServiceInterface
     */
    public function bind(Application $app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Do nothing here
     */
    public function bound()
    {

    }
}