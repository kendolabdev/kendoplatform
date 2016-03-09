<?php

namespace Kendo\Image;

use Kendo\Kernel\Application;
use Kendo\Kernel\KernelService;

/**
 * Class ImageManager
 *
 * @package Kendo\Image
 */
class ImageManager extends KernelService
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * Config
     *
     * @var array
     */
    public $config = [
        'driver' => 'gd'
    ];

    /**
     * @param \Kendo\Kernel\Application $app
     *
     * @return \Kendo\Image\InterventionManager
     */
    public function bind(Application $app)
    {
        $this->app = $app;

        return new InterventionManager();
    }
}
