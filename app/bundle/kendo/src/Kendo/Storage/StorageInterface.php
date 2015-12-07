<?php
namespace Kendo\Storage;

/**
 * Interface StorageInterface
 *
 * @package Kendo\Storage
 */
interface StorageInterface
{

    /**
     * Construct a driver object with params
     *
     * @param array $params
     */
    public function __construct($params);

    /**
     * Get storage identity, Its important for system has multiple drivers.
     *
     * @return string
     */
    public function getId();

    /**
     * Set identity for storage driver.
     *
     * @param $value
     */
    public function setId($value);


    /**
     * Get full url from relative path
     *
     * @param $path
     *
     * @return string
     */
    public function getUrl($path);

    /**
     * Get full path from relative path
     *
     * @param string $path Relative path
     *
     * @return string Full path
     */
    public function getPath($path);

    /**
     * Get data for relative path
     *
     * @param  string $relativePath
     *
     * @return mixed
     */
    public function get($relativePath);

    /**
     * @param mixed  $data         Data to write
     * @param string $relativePath Relative path
     * @param bool   $overwrite    Overwite to old file
     * @param bool   $silent       Throw exception or not
     *
     * @return bool
     */
    function put($data, $relativePath, $overwrite = true, $silent = false);

    /**
     * @param string $fullFromPath   Local full path
     * @param string $relativeToPath Remote relative path
     * @param bool   $overwrite      Overwrite old file
     * @param bool   $silent         Throws exception or not
     *
     * @return true
     */
    public function copyToLocal($fullFromPath, $relativeToPath, $overwrite = true, $silent = false);

    /**
     * @param string $fullFromPath   Local full path
     * @param string $relativeToPath Remote relative path
     * @param bool   $overwrite      Overwrite old file
     * @param bool   $silent         Throws exception or not
     *
     * @return true
     */
    public function copyFromLocal($fullFromPath, $relativeToPath, $overwrite = true, $silent = false);

    /**
     * Delete strorage file
     *
     * @param  string $relativePath Relative path
     * @param  bool   $silent       Throws exception or not
     *
     * @return bool
     */
    public function delete($relativePath, $silent = true);

}
