<?php
namespace Picaso\Storage;

/**
 * Interface PathGeneratorInterface
 *
 * @package Picaso\Storage
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