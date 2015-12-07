<?php

namespace Kendo\Storage;

/**
 * Class LocalStorage
 *
 * @package Kendo\Storage
 */
class LocalStorage implements StorageInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $_baseUrl;

    /**
     * @var string
     */
    protected $_basePath;

    /**
     * @param array $params
     */
    public function __construct($params)
    {
        if (empty($params['id'])) {
            throw new \InvalidArgumentException("Missing params [id]");
        }

        $this->setId($params['id']);

        $this->setBasePath(isset($params['basePath']) ? $params['basePath'] : null);
        $this->setBaseUrl(isset($params['baseUrl']) ? $params['baseUrl'] : null);
    }

    /**
     * @param string $basePath
     */
    private function setBasePath($basePath)
    {
        if (empty($basePath)) {
            $basePath = Kendo_PUBLIC_DIR;
        }

        $this->_basePath = rtrim($basePath, '/') . '/';
    }

    /**
     * @param string $baseUrl
     */
    private function setBaseUrl($baseUrl)
    {
        if (empty($baseUrl)) {
            $baseUrl = Kendo_BASE_URL;
        }
        $this->_baseUrl = rtrim($baseUrl, '/') . '/';
    }

    /**
     * Get storage identity, Its important for system has multiple drivers.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set identity for storage driver.
     *
     * @param $value
     */
    public function setId($value)
    {
        $this->id = $value;
    }

    /**
     * Get full url from relative path
     *
     * @param $path
     *
     * @return string
     */
    public function getUrl($path)
    {
        return $this->getBaseUrl() . $path;
    }

    /**
     * @return string
     */
    private function getBaseUrl()
    {
        return $this->_baseUrl;
    }

    /**
     * Get data for relative path
     *
     * @param  string $relativePath
     *
     * @return mixed
     */
    public function get($relativePath)
    {
        return @file_get_contents($relativePath);
    }

    /**
     * @param mixed  $data         Data to write
     * @param string $relativePath Relative path
     * @param bool   $overwrite    Overwite to old file
     * @param bool   $silent       Throw exception or not
     *
     * @return bool
     */
    function put($data, $relativePath, $overwrite = true, $silent = false)
    {
        $path = $this->getPath($relativePath);

        if (file_exists($path)) {
            if ($overwrite) {
                if (!@unlink($path)) {
                    if ($silent) {
                        return false;
                    } else {
                        throw new \RuntimeException("File exist");
                    }
                }
            } else {
                throw new \RuntimeException("File exists");
            }
        }

        if (!file_put_contents($path, $data)) {
            if ($silent) {
                return false;
            } else {
                throw new \RuntimeException("File exist");
            }
        }

        @chmod($path, 0644);

        return true;
    }

    /**
     * Get full path from relative path
     *
     * @param string $path Relative path
     *
     * @return mixed
     */
    public function getPath($path)
    {
        return $this->getBasePath() . $path;
    }

    /**
     * @return string
     */
    private function getBasePath()
    {

        return $this->_basePath;
    }

    /**
     * @param string $fullFromPath   Local full path
     * @param string $relativeToPath Remote relative path
     * @param bool   $overwrite      Overwrite old file
     * @param bool   $silent         Throws exception or not
     *
     * @return true
     */
    public function copyFromLocal($fullFromPath, $relativeToPath, $overwrite = true, $silent = false)
    {
        $path = $this->getPath($relativeToPath);

        if (@file_exists($path)) {
            if ($overwrite) {
                if (!@unlink($path)) {
                    if ($silent) {
                        return false;
                    } else {
                        throw new \RuntimeException("File is exists");
                    }
                }
            } else if ($silent) {
                return false;
            } else {
                throw new \RuntimeException("File is exists");
            }
        }

        if (!is_dir(dirname($path))) {
            if (!mkdir(dirname($path), 0755, 1)) {
                throw new \RuntimeException("Could not create directory " . dirname($path));
            }
        }

        if (!copy($fullFromPath, $path)) {
            if (!$silent) {
                throw new \RuntimeException("Could not copy file [$fullFromPath] ->  [$path]");
            }

            return false;
        }

        return true;
    }


    /**
     * @param string $fullFromPath   Local full path
     * @param string $relativeToPath Remote relative path
     * @param bool   $overwrite      Overwrite old file
     * @param bool   $silent         Throws exception or not
     *
     * @return true
     */
    public function copyToLocal($fullFromPath, $relativeToPath, $overwrite = true, $silent = false)
    {
        $path = $this->getPath($relativeToPath);

        if (!@file_exists($fullFromPath)) {
            if ($silent) {
                return false;
            } else {
                throw new \RuntimeException("File does not exists.");
            }
        }

        if (@file_exists($path)) {
            if ($overwrite) {
                $this->delete($path, false);
            } else if ($silent) {
                return false;
            } else {
                throw new \RuntimeException("File is exists");
            }
        }

        if (!@copy($fullFromPath, $path)) {
            if (!$silent) {
                throw new \RuntimeException("Could not copy file");
            }

            return false;
        }

        return true;
    }

    /**
     * Delete strorage file
     *
     * @param  string $relativePath Relative path
     * @param  bool   $silent       Throws exception or not
     *
     * @return bool
     */
    public function delete($relativePath, $silent = true)
    {
        $path = $this->getPath($relativePath);

        if (!@unlink($path)) {
            if (!$silent) {
                throw new \RuntimeException("Could not remove file " . $relativePath);

            }

            return false;
        }

        return true;
    }
}