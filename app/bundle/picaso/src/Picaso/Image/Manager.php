<?php

namespace Picaso\Image;

use Intervention\Image\ImageManager;

/**
 * Class Manager
 *
 * @package Picaso\Image
 */
class Manager extends ImageManager
{
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
}
