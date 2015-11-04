<?php

namespace Picaso\Application;

use Core\Model\CoreExtension;

/**
 * Class Manager
 *
 * @package Picaso\Application
 */
class Manager
{

    /**
     * @var array
     */
    private $modules = [];

    /**
     * @return array
     */
    public function getModuleOptions()
    {
        return $this->service()->getModuleOptions();
    }

    /**
     * @return \Core\Service\ExtensionService
     */
    public function service()
    {
        return \App::service('core.extension');
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

        $data = $this->loadEnableModules();

        $autoload = \App::autoload();

        foreach ($data as $name => $value) {

            $autoload->addNamespace($value['namespace'], PICASO_MODULE_DIR . $value['path']);

            $class = '\\' . $value['namespace'] . '\\Module';

            $file = PICASO_MODULE_DIR . $value['path'] . '/Module.php';

            include_once $file;

            $this->modules[ $name ] = new $class;
        }

        // boot

        foreach ($this->modules as $module) {
            $module->start();
        }

        define('PICASO_MODULE_STARTED', true);

        \App::hook()
            ->start();

        foreach ($this->modules as $module) {
            $module->complete();
        }

        define('PICASO_MODULE_COMPLETED', true);
    }

    /**
     * Export enabled modules
     */
    public function exportEnabledModulesToIncludeFile()
    {
        $data = $this->_loadEnableModulesFromDatabase();
        $content = '<?php defined("PICASO") or die("Access Denied"); return ' . var_export($data, true) . ';';
        $filename = PICASO_CONFIG_DIR . '/module.conf.php';

        file_put_contents($filename, $content);
    }


    /**
     * @return array
     */
    public function loadEnableModules()
    {
        if (file_exists($file = PICASO_CONFIG_DIR . '/module.conf.php'))
            return include $file;

        return \App::cache()
            ->get(['picaso', 'application', 'loadEnableModules'], 0, function () {
                return $this->_loadEnableModulesFromDatabase();
            });
    }

    /**
     * @return array
     */
    public function _loadEnableModulesFromDatabase()
    {

        $result = [];

        $items = \App::table('core.core_extension')
            ->select()
            ->where('is_system=1 or is_active=1', null)
            ->where('extension_type=?', 'module')
            ->order('load_order', 1)
            ->all();

        foreach ($items as $item) {
            if (!$item instanceof CoreExtension) continue;
            $result [ $item->getName() ] = [
                'namespace' => $item->getNamespace(),
                'path'      => $item->getPath(),
            ];
        }

        return $result;
    }
}