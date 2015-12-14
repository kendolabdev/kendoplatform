<?php

namespace Kendo\Image;

use Intervention\Image\ImageManager;
use Kendo\Kernel\Application;
use Kendo\Kernel\ServiceInterface;

/**
 * Class Manager
 *
 * @package Kendo\Image
 */
class ImageProcess extends ImageManager implements ServiceInterface
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
     * @param $path
     *
     * @return \Intervention\Image\Image
     */
    public function load($path)
    {
        return $this->make($path);
    }

    public function bind(Application $app)
    {
        $this->app = $app;
    }

    public function alias()
    {
        return [];
    }

    /**
     * deferred
     */
    public function bound()
    {

    }
}
