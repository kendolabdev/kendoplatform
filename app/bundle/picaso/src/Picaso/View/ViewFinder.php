<?php

namespace Picaso\View;

/**
 * Class ViewFinder
 *
 * @package Picaso\View
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
     * @var string
     */
    protected $mobileSuffix = '.mobile.tpl';

    /**
     * @var bool
     */
    protected $checkMobile = false;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->paths = [
            $this->getDefaultName() => PICASO_TEMPLATE_DIR . '/default',
        ];

        if (\App::request()->isMobile() && !\App::request()->isTablet()) {
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

        if ($this->checkMobile) {
            $_script = '/' . trim($script, '/') . $this->mobileSuffix;
            foreach ($this->paths as $path) {
                if (file_exists($file = $path . $_script)) {
                    return $file;
                }
            }
        }

        $_script = '/' . trim($script, '/') . $this->suffix;

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
        $this->paths = $paths;
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
     * @return string
     */
    public function getMobileSuffix()
    {
        return $this->mobileSuffix;
    }

    /**
     * @return boolean
     */
    public function isCheckMobile()
    {
        return $this->checkMobile;
    }
}