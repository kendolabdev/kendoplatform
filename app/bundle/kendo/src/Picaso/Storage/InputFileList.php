<?php
namespace Picaso\Storage;

/**
 * Class InputFileList
 *
 * @package Picaso\Storage
 */
class InputFileList
{
    /**
     * @var array
     */
    private $files = [];

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->files);
    }

    /**
     * @param int $index
     *
     * @return InputFile
     */
    public function getFile($index)
    {
        if (empty($this->files[ $index ])) {
            throw new \InvalidArgumentException("Offset [$index] is empty");
        }

        return $this->files[ $index ];
    }

    /**
     * @param $file
     */
    public function addFileInput(InputFile $file)
    {
        $this->files[] = $file;
    }

    /**
     * @param string $name
     * @param string $type
     * @param string $path
     * @param int    $size
     * @param string $source
     */
    public function addFile($name, $type, $path, $size, $source)
    {
        $this->files[] = new InputFile($name, $type, $path, $size, $source);
    }
}