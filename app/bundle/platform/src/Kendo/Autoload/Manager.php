<?php

/**
 * @package    Kendo
 * @subpackage Autoload
 * @author     Nam Nguyen
 */

namespace Kendo\Autoload;

/**
 *
 * @codeCoverageIgnore
 *
 * Class Manager
 *
 * @package Kendo\Autoload
 */
class Manager
{

    /**
     * @var Manager
     */
    static private $instance;

    /**
     * @var array
     */
    private $classes = [];

    /**
     * @var array
     */
    private $psr = [];

    /**
     * constructor
     *
     * @ignore
     */
    private function __construct()
    {
        $this->register('Kendo', [
            KENDO_BUNDLE_DIR . '/platform/src/Kendo',
            KENDO_BUNDLE_DIR . '/platform/test/Kendo',
        ]);

        $this->register('Platform', [
            KENDO_BUNDLE_DIR . '/platform/src/Platform',
            KENDO_BUNDLE_DIR . '/platform/test/Platform',
        ]);

        $this->registerAutoload();
    }

    /**
     * Register class autoload
     *
     * @codeCoverageIgnore
     *
     * TODO: check php version compatible
     */
    protected function registerAutoload()
    {
        spl_autoload_register([$this, 'loadClass'], false, false);
    }

    /**
     * @return Manager
     */
    static public function getInstance()
    {
        if (null == self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string       $package
     * @param string|array $paths
     *
     * @return void
     */
    public function register($package, $paths)
    {
        if (is_string($paths)) {
            $this->psr[ $package ][] = $paths;
        }

        foreach ($paths as $path0) {
            $this->psr[ $package ][] = $path0;
        }
    }


    /**
     * @param array $pairs [namespace => path]
     */
    public function bindAll($pairs)
    {
        foreach ($pairs as $class => $path) {
            $this->classes[ $class ] = $path;
        }
    }

    /**
     * @param $class
     * @param $path
     */
    public function bind($class, $path)
    {
        $this->classes[ $class ] = $path;
    }

    /**
     * Load class
     *
     * @param string $class
     *
     * @return bool
     */
    public function loadClass($class)
    {
        if (false != ($path = $this->findPath($class))) {
            include_once $path;

            return true;
        }

        return false;
    }

    /**
     * @param string $class
     *
     * @return string|false
     */
    public function findPath($class)
    {
        /**
         * Strip global namespace
         */
        if ('\\' == substr($class, 0, 1)) {
            $class = substr($class, 1);
        }

        /**
         * check exisiting class map.
         */
        if (isset($this->classes[ $class ])) {
            return $this->classes[ $class ];
        }

        $arr = explode('_', str_replace('\\', '_', $class));

        $vendor = array_shift($arr);

        if (isset($this->psr[ $vendor ])) {
            foreach ($this->psr[ $vendor ] as $directory) {
                $checkPath = $directory . KENDO_DS . implode(KENDO_DS, $arr) . '.php';
                if (file_exists($checkPath)) {
                    return $checkPath;
                } else if (empty($arr)) {
                    $checkPath = $this->psr[ $vendor ] . KENDO_DS . $vendor . '.php';
                    if (file_exists($checkPath)) {
                        return $checkPath;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param  $class
     *
     * @return string
     */
    public function getPath($class)
    {
        if ('\\' == substr($class, 0, 1)) {
            $class = substr($class, 1);
        }

        /**
         * Check bound class
         */
        if (isset($this->classes[ $class ])) {
            return $this->classes[ $class ];
        }

        $arr = explode('_', str_replace('\\', '_', $class));
        $vendor = array_shift($arr);

        if (isset($this->psr[ $vendor ])) {
            foreach ($this->psr[ $vendor ] as $directory) {
                $checkPath = $directory . KENDO_DS . implode(KENDO_DS, $arr) . '.php';

                return $checkPath;
            }
        }

        return false;
    }
}
