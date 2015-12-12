<?php

namespace Kendo\Application;

/**
 * Class Manager
 *
 * @package Kendo\Application
 */
class Manager
{

    /**
     * @var array
     */
    private $modules = [];

    /**
     * Load Bundles namespace, please excludes result Platform, Base, Kendo
     *
     * @return array [vendor=> [path, path test ]
     */
    public function loadEnableBundles()
    {

        $result = [];

        /**
         * Do not overwrite theses settings.
         */
        unset($result['Platform'], $result['Base'], $result['Kendo']);

        return $result;
    }

    /**
     * @return array
     */
    public function getModuleOptions()
    {
        return $this->service()->getModuleOptions();
    }

    /**
     * @return \Platform\Core\Service\ExtensionService
     */
    public function service()
    {
        return \App::service('platform_core_extension');
    }

    /**
     * @return array
     */
    public function getActiveModuleNames()
    {
        return array_keys($this->modules);
    }

    /**
     * @param string $key
     *
     * @return Module
     */
    public function getModule($key)
    {
        return !empty($this->modules[ $key ]) ? $this->modules[ $key ] : null;
    }

    /**
     * call method bootstrap
     */
    public function bootstrap()
    {
        if (!\App::db()->isInstalled())
            return;

        $bundles = $this->loadEnableBundles();
        $autoload = \App::autoload();
        foreach ($bundles as $vendor => $paths) {
            $autoload->register($vendor, $paths);
        }

        $this->modules = $this->loadEnableModules();

        \App::hookService()->start();

        \App::routingService()->start();
    }

    /**
     * Export enabled modules
     */
    public function exportEnabledModulesToIncludeFile()
    {
        $data = $this->loadEnableModuleFromRepository();
        $content = '<?php defined("Kendo") or die("Access Denied"); return ' . var_export($data, true) . ';';
        $filename = KENDO_CONFIG_DIR . '/module.conf.php';

        file_put_contents($filename, $content);
    }


    /**
     * @return array
     */
    public function loadEnableModules()
    {
        return \App::cacheService()
            ->get(['Kendo', 'application', 'loadEnableModules'], 0, function () {
                return $this->loadEnableModuleFromRepository();
            });
    }

    /**
     * @return array
     */
    public function loadEnableModuleFromRepository()
    {

        return \App::table('platform_core_extension')
            ->select()
            ->where('is_system=1 OR is_active=1', null)
            ->where('extension_type=?', 'module')
            ->order('load_order', 1)
            ->toPairs('name', 'loader_name');
    }
}