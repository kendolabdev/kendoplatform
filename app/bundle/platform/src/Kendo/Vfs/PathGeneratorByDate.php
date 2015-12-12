<?php
namespace Kendo\Vfs;

/**
 * Class PathGeneratorByDate
 *
 * @package Kendo\Storage
 */
class PathGeneratorByDate implements PathGeneratorInterface
{
    /**
     * @param string $dir
     * @param string $filename
     * @param string $extension
     *
     * @return string
     */
    public function getPattern($dir, $filename, $extension)
    {
        if (null == $filename) {
            $filename = uniqid();
        }

        return trim($dir, '/') . '/' . date('Y/m/d') . '/' . $filename . '_$maker' . $extension;
    }
}