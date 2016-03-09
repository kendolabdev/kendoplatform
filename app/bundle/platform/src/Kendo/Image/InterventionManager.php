<?php
namespace Kendo\Image;

use Intervention\Image\ImageManager as Manager;

/**
 * Class InterventionManager
 *
 * @package Kendo\Image
 */
class InterventionManager extends Manager
{
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