<?php
namespace Picaso\Application;

/**
 * Class Filesystem
 *
 * @package Picaso\Application
 */
class Filesystem
{

    /**
     * @param           $destination
     * @param           $paths
     *
     * @return bool
     */
    public function buildCompress($destination, $paths)
    {

        $this->validateDestination($destination);


        $zip = new \ZipArchive();

        if (false == ($zip->open($destination, \ZipArchive::CREATE))) {
            throw new \RuntimeException("Could not open $destination to write");
        }

        foreach ($paths as $path) {
            $directory = new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS);
            $iterator = new \RecursiveIteratorIterator($directory);

            foreach ($iterator as $info) {
                $pathname = $info->getPathName();

                $temp = $this->correctPath($pathname);

                if (!$temp) continue;


                if ($info->isDir()) {
                    $zip->addEmptyDir($temp);
                }
                if ($info->isFile()) {
                    $zip->addFile($pathname, $temp);
                }
            }
        }
        $zip->close();

        return true;
    }

    /**
     * @param $pathname
     *
     * @return string
     */
    protected function correctPath($pathname)
    {
        if (strpos($pathname, '.git')) return false;

        $temp = substr($pathname, strlen(PICASO_ROOT_DIR) + 1);

        if (substr($temp, 0, 1) == '.')
            return false;

        return $temp;
    }

    /**
     * @param $destination
     *
     * @return bool
     */
    protected function validateDestination($destination)
    {
        $dir = dirname($destination);

        if (file_exists($destination)) {
            if (!@unlink($destination)) {
                throw new \RuntimeException("Could not overwrite $destination");
            }
        }

        if (!is_dir($dir)) {
            if (!@mkdir($dir)) {
                throw new \InvalidArgumentException("Could not open $dir to build compress file.");
            }
            @chmod($dir, 0777);
        }

        return true;
    }

    /**
     * @param string $filename
     * @param string $destination
     */
    public function extractCompress($filename, $destination)
    {

        $this->clearDirectory($destination);

        $zip = new \ZipArchive();
        $zip->open($filename);
        $zip->extractTo($destination);
        $zip->close();
    }

    /**
     * @param $destination
     */
    public function clearDirectory($destination)
    {
        if (!is_dir($destination)) return;

        $directory = new \RecursiveDirectoryIterator($destination, \RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($directory, \RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($iterator as $info) {
            $pathname = $info->getPathName();

            if ($info->isDir()) {
                if (!@rmdir($pathname)) {
                    throw new \InvalidArgumentException("Could not remove $pathname");
                }
            }

            if ($info->isFile()) {
                if (!@unlink($pathname)) {
                    throw new \InvalidArgumentException("Could not remove $pathname");
                }
            }

        }
        @rmdir($destination);
    }
}