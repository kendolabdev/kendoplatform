<?php
namespace Kendo\Vfs;
/**
 * Class SshObject
 *
 * @package Kendo\Vfs
 */
class SshObject extends AbstractObject
{
    /**
     * @param string $mode
     *
     * @return SshObject
     * @throws Exception
     */
    public function open($mode = 'r')
    {
        $qPath = 'ssh2.sftp://' . $this->driver->getSftpResource() . $this->path;

        $resource = fopen($qPath, $mode);

        if (!$resource) {
            throw new Exception(sprintf('Unable to open file "%s" in mode "%s"', $qPath, $mode));
        }

        $this->resource = $resource;

        return $this;
    }

    /**
     * @return bool
     */
    public function close()
    {
        $ret = fclose($this->getResource());
        $this->resource = null;

        return $ret;
    }

    /**
     * @return bool
     */
    public function end()
    {
        return feof($this->getResource());
    }

    /**
     * @return bool
     */
    public function flush()
    {
        return fflush($this->getResource());
    }

    /**
     * @param $length
     *
     * @return string
     */
    public function read($length)
    {
        return fread($this->getResource(), $length);
    }

    /**
     * @return bool
     */
    public function rewind()
    {
        return rewind($this->getResource());
    }

    /**
     * @param     $offset
     * @param int $whence
     *
     * @return int
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        return fseek($this->getResource(), $offset, $whence);
    }

    /**
     * @return array
     */
    public function stat()
    {
        return fstat($this->getResource());
    }

    /**
     * @return int
     */
    public function tell()
    {
        return ftell($this->getResource());
    }

    /**
     * @param $size
     *
     * @return bool
     */
    public function truncate($size)
    {
        return ftruncate($this->getResource(), $size);
    }

    /**
     * @param      $string
     * @param null $length
     *
     * @return int
     */
    public function write($string, $length = null)
    {
        if (null === $length) {
            return fwrite($this->getResource(), $string);
        } else {
            return fwrite($this->getResource(), $string, $length);
        }
    }
}