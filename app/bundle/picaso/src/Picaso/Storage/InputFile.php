<?php
namespace Picaso\Storage;

/**
 * Class InputFile
 *
 * @package Picaso\Storage
 */
class InputFile
{
    /**
     * Uploaded file
     */
    const SOURCE_UPLOAD = 'upload';

    /**
     * Storage in file temp table
     */
    const SOURCE_TEMP = 'temp';

    /**
     * Remote file
     */
    const SOURCE_URL = 'url';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $path;

    /**
     * @var int
     */
    private $size;

    /**
     * @var string
     */
    private $source;

    /**
     * @param string $name
     * @param string $type
     * @param string $path
     * @param int    $size
     * @param string $source
     */
    public function __construct($name, $type, $path, $size, $source)
    {
        $this->setName($name);
        $this->setType($type);
        $this->setPath($path);
        $this->setSize($size);
        $this->setSource($source);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }


}