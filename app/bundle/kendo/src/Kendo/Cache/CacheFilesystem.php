<?php

namespace Kendo\Cache;

/**
 * Class CacheFilesystem
 *
 * @package Kendo\Cache
 */
class CacheFilesystem implements CacheInterface
{

    /**
     * @var string
     */
    protected $directory;

    /**
     * @var string
     */
    protected $prefix = 'Kendo.';

    /**
     * @var int
     */
    protected $lifetime = 86400;

    /**
     * @param  array $params
     */
    public function __construct($params)
    {
        $directory = null;

        if (!empty($params['path']))
            $directory = $params['path'];

        if (!empty($params['prefix']))
            $this->prefix = $params['prefix'];


        if (!empty($params['lifetime']))
            $this->lifetime = (int)$params['lifetime'];

        if (!$this->lifetime)
            $this->lifetime = 0;

        if (!$directory)
            $directory = Kendo_TEMP_DIR . '/cache';



        if (!is_dir($directory) and !@mkdir($directory, 0777, true)){
            @chmod($directory,0777);
            throw new \InvalidArgumentException(sprintf('"%s" is not writable', $this->directory));
        }

        $this->directory = $directory;
    }

    /**
     * @param string|array $key
     *
     * @return string
     */
    public function key($key)
    {
        if (is_array($key))
            return implode('_', $key);

        return $key;

    }

    /**
     * @param string|array  $key
     * @param int           $minutes
     * @param \Closure|null $closure
     *
     * @return mixed
     */
    public function get($key, $minutes = 0, \Closure $closure = null)
    {
        $key = $this->key($key);

        if (false != ($path = $this->getPath($key, false))) {
            if (file_exists($path) && '' != ($string = file_get_contents($path))) {
                $result = @json_decode($string, true);
                if ($minutes == 0 or @$result['lifetime'] > time()) {
                    return @$result['val'];
                }
            }
        }

        if (null != $closure) {

            $data = $closure();

            $this->set($key, $data, $minutes);

            return $data;
        }

        return null;
    }

    /**
     * @param      $key
     * @param bool $checkDirectory
     * @param bool $silent
     *
     * @return bool|string
     */
    protected function getPath($key, $checkDirectory = false, $silent = true)
    {

        $string = hash('sha256', $this->prefix . $key);

        if ($checkDirectory) {
            if (!is_dir($dir = $this->directory . '/' . substr($string, 0, 2))) {
                if (!@mkdir($dir, 7777, true)) {
                    if (false == $silent)
                        throw new \InvalidArgumentException(sprintf('Directory "%s" is not writable.', $dir));
                    return false;
                }
                @chmod($dir, 0777);
            }
        }

        return $this->directory . '/' . substr($string, 0, 2) . '/' . $string;
    }

    /**
     * @param string|array $key
     * @param mixed        $data
     * @param null         $minutes
     *
     * @return boolean
     */
    public function set($key, $data, $minutes = null)
    {
        $key = $this->key($key);

        $lifetime = time() + ($minutes ? (int)$minutes * 60 : $this->lifetime * 60);

        if (false != ($path = $this->getPath($key, true, true))) {
            if (null != ($fp = fopen($path, 'w+'))) {
                fwrite($fp, json_encode(['lifetime' => $lifetime, 'val' => $data]));
                fclose($fp);
                @chmod($path,0777);
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function forget($key)
    {
        $key = $this->key($key);;

        if (false != ($path = $this->getPath($key, false))) {
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        return true;
    }

    /**
     * @param string $directory
     */
    public function _flush($directory)
    {
        $iterator = new \DirectoryIterator ($directory);
        foreach ($iterator as $info) {
            if ($info->isDot()) {
            } else if ($info->isFile()) {
                $filename = $directory . '/' . $info->__toString();
                @unlink($filename);
            } else if ($info->isDir()) {
                $this->_flush($directory . '/' . $info->__toString());
                @rmdir($directory . '/' . $info->__toString());
            }
        }
    }

    public function flush()
    {
        $this->_flush($this->directory);
    }
}