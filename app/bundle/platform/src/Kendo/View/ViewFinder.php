<?php

namespace Kendo\View;

/**
 * Class ViewFinder
 *
 * @package Kendo\View
 */
class ViewFinder
{
    /**
     * @var string
     */
    protected $defaultName = 'default';

    /**
     * @var array
     */
    protected $paths = [];

    /**
     * @var string
     */
    protected $suffix = '.tpl';

    /**
     * @var bool
     */
    protected $checkMobile = false;

    /**
     * @var array
     */
    protected $scripts = [];

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->paths = [
            'default' => KENDO_TEMPLATE_DIR . '/default',
        ];

        if (\App::requestService()->isMobile() && !\App::requestService()->isTablet()) {
            $this->checkMobile = true;
        }
    }

    /**
     * @return string
     */
    public function getDefaultName()
    {
        return $this->defaultName;
    }

    /**
     * @param string $defaultName
     */
    public function setDefaultName($defaultName)
    {
        $this->defaultName = $defaultName;
    }

    /**
     * @param string $script
     *
     * @return string
     */
    public function findPath($script)
    {
        if (empty($script)) {
            return false;
        }

        $script = trim($script, '/');

        /**
         * Retry the first time
         */
        if ($this->checkMobile) {
            if (!empty($this->scripts[ $script . '.mobile' ])) {
                return KENDO_ROOT_DIR . $this->scripts[ $script ] . '/' . $script . '.mobile' . $this->suffix;
            }
        }

        if (!empty($this->scripts[ $script ])) {
            return KENDO_ROOT_DIR . $this->scripts[ $script ] . '/' . $script . $this->suffix;
        }

        /**
         * Retry the second time
         */
        if ($this->checkMobile) {
            $_script = '/' . $script . '.mobile' . $this->suffix;
            foreach ($this->paths as $path) {
                if (file_exists($file = $path . $_script)) {
                    return $file;
                }
            }
        }

        $_script = '/' . $script . $this->suffix;

        foreach ($this->paths as $path) {
            if (file_exists($file = $path . $_script)) {
                return $file;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * @param array $paths
     */
    public function setPaths($paths)
    {
        $paths = array_unique($paths);

        $this->paths = $paths;

        $this->scripts = \App::cacheService()
            ->get($paths, 0, function () use ($paths) {
                return $this->_buildScriptPaths($paths);
            });
    }

    /**
     * @param array $paths
     *
     * @return array
     */
    public function _buildScriptPaths($paths = [])
    {
        $files = [];

        if (empty($paths))
            $paths = $this->paths;

        foreach ($paths as $directory) {

            /**
             * Escape no directory
             */
            if (!is_dir($directory)) {
                continue;
            }

            $recursiveDirectoryIterator = new \RecursiveDirectoryIterator($directory);
            $iteratorMode  = \RecursiveIteratorIterator::CHILD_FIRST;

            $iterator = new \RecursiveIteratorIterator($recursiveDirectoryIterator, $iteratorMode);

            foreach ($iterator as $info) {
                if (!$info->isFile()) continue;
                if ($info->getExtension() != 'tpl') continue;
                $pathname = $info->getPathname();

                $script = trim(substr($pathname, strlen($directory)), DIRECTORY_SEPARATOR);

                $script = trim(str_replace(DIRECTORY_SEPARATOR, '/', substr($script, 0, strlen($script) - 4)), '/');

                if (!empty($files[ $script ])) continue;

                $files[ $script ] = substr($directory, strlen(KENDO_ROOT_DIR));
            }
        }


        return $files;
    }

    /**
     * @param string $name
     * @param string $directory
     */
    public function addPath($name, $directory)
    {
        $this->paths[ $name ] = $directory;
    }

    /**
     * @param string $name
     */
    public function removePath($name)
    {
        if (isset($this->paths[ $name ])) {
            unset($this->paths[ $name ]);
        }
    }

    /**
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }


    /**
     * @return boolean
     */
    public function isCheckMobile()
    {
        return $this->checkMobile;
    }
}