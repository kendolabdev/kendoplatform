<?php
namespace Kendo\Vfs;

/**
 * Class FtpObject
 *
 * @package Kendo\Vfs
 */
class FtpObject extends AbstractObject
{
    /**
     * @var string
     */
    protected $_tmpFile;

    /**
     * @param string $mode
     *
     * @return FtpObject
     */
    public function open($mode = 'r')
    {
        // Create temporary file
        if (null === $this->_tmpFile) {
            $this->_tmpFile = tempnam('/tmp', 'engine_vfs_object');
            if (!$this->_tmpFile) {
                throw new ObjectException('Unable to create temporary file');
            }
        }

        // Transfer remote file to temporary file
        $this->driver->get($this->_tmpFile, $this->path);

        // Open temporary file
        $resource = fopen($this->_tmpFile, $mode);
        if (!$resource) {
            throw new ObjectException(sprintf('Unable to open file "%s" in mode "%s"', $this->path, $mode));
        }

        $this->resource = $resource;

        return $this;
    }

    /**
     * @return bool
     */
    public function close()
    {
        // Flush first (to get it to re-upload)
        $this->flush();
        // Close
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
     * @return bool|mixed
     */
    public function flush()
    {
        $ret = fflush($this->getResource());
        // Also send back to server
        $ret &= $this->driver->put($this->path, $this->_tmpFile);

        return $ret;
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
     *
     */
    public function stat()
    {
        throw new ObjectException(sprintf('Method %s is not implemented', __METHOD__));
        //return fstat($this->getResource());
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