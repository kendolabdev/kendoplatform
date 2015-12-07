<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Kendo
 */

namespace Kendo\Autoload;

/**
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
    private $namespaces = [];

    /**
     * constructor
     *
     * @ignore
     */
    private function __construct()
    {
        // register 2 core module
        $this->namespaces['Kendo'] = dirname(dirname(__FILE__));
        $this->namespaces['Core'] = Kendo_MODULE_DIR . '/base/src/Core';

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
     * @param string $package
     * @param string $path
     *
     * @return void
     */
    public function addNamespace($package, $path)
    {
        $this->namespaces[ $package ] = $path;
    }

    /**
     * Example code <br />
     * <code>
     * \App::autoload()->addNamespaces([
     *  'Blogs'=> Kendo_MODULE_DIR . '/younet/src/Blogs'
     *  'Activity'=> Kendo_MODULE_DIR . '/younet/src/Activity'
     * ])
     * </code>
     *
     * @param array $pairs ( package=> path)
     *
     * @return void
     */
    public function addNamespaces($pairs)
    {
        foreach ($pairs as $package => $path) {
            $this->namespaces[ $package ] = $path;
        }
    }

    /**
     * @param array $pairs [namespace => path]
     */
    public function addClasses($pairs)
    {
        foreach ($pairs as $class => $path) {
            $this->classes[ $class ] = $path;
        }
    }

    /**
     * @param $class
     * @param $path
     */
    public function addClass($class, $path)
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
        // strip global namespace
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

        $namespace = array_shift($arr);

        if (isset($this->namespaces[ $namespace ])) {
            $checkPath = $this->namespaces[ $namespace ] . Kendo_DS . implode(Kendo_DS, $arr) . '.php';
            if (file_exists($checkPath)) {
                return $checkPath;
            } else if (empty($arr)) {
                $checkPath = $this->namespaces[ $namespace ] . Kendo_DS . $namespace . '.php';
                if (file_exists($checkPath)) {
                    return $checkPath;
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
         * check exisiting class map.
         */
        if (isset($this->classes[ $class ])) {
            return $this->classes[ $class ];
        }

        $arr = explode('_', str_replace('\\', '_', $class));

        $namespace = array_shift($arr);

        if (isset($this->namespaces[ $namespace ])) {
            $checkPath = $this->namespaces[ $namespace ] . Kendo_DS . implode(Kendo_DS, $arr) . '.php';

            return $checkPath;
        }

        return false;
    }
}
