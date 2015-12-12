<?php
namespace Kendo\Storage;

/**
 * Interface PathGeneratorInterface
 *
 * @package Kendo\Storage
 */
interface PathGeneratorInterface
{

    /**
     * @param string $dir
     * @param string $filename
     * @param string $extension
     *
     * @return string
     */
    public function getPattern($dir, $filename, $extension);
}