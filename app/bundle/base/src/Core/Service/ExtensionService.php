<?php
namespace Core\Service;

use Core\Model\CoreExtension;
use Picaso\Application\ModuleInstallHandler;
use Picaso\Application\ThemeInstallHandler;
use Picaso\Hook\SimpleContainer;

/**
 * Class ExtensionService
 *
 * @package Core\Service
 */
class ExtensionService
{

    /**
     * @var array
     */
    protected $packages = [];

    /**
     * @param string $id
     *
     * @return \Core\Model\CoreExtension
     */
    public function findExensionById($id)
    {
        return \App::table('core.core_extension')
            ->select()
            ->where('id=?', (string)$id)
            ->one();
    }

    /**
     * @param string $name
     *
     * @return \Core\Model\CoreExtension
     */
    public function findExtensionByName($name)
    {
        return \App::table('core.core_extension')
            ->select()
            ->where('name=?', (string)$name)
            ->one();
    }

    /**
     * @return array
     */
    public function getModuleOptions()
    {
        $items = \App::table('core.core_extension')
            ->select()
            ->where('extension_type=?', 'module')
            ->where('is_active=?', 1)
            ->order('name', 1)
            ->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof CoreExtension) continue;
            $options[] = [
                'value' => $item->getName(),
                'label' => $item->getTitle(),
            ];
        }

        return $options;
    }

    /**
     * @param $moduleList
     *
     * @return array
     */
    public function getListExtensionByModuleName($moduleList)
    {
        return \App::table('core.core_extension')
            ->select()
            ->where('name IN ?', $moduleList)
            ->toAssocs();

    }

    /**
     * @return array
     */
    protected function _collectListPackageInformation()
    {
        $directory = PICASO_ROOT_DIR . '/app/package';

        $iterator = new \DirectoryIterator ($directory);

        $result = [];

        foreach ($iterator as $info) {

            if (!$info->isFile()) continue;

            $baseName = $info->getBasename('.json');
            $fileName = $info->__toString();
            if ($baseName == $fileName) continue;

            $fileJson = $directory . '/' . $baseName . '.json';
            $result [ $baseName ] = json_decode(file_get_contents($fileJson), true);
        }

        return $result;
    }

    public function collectListPackageInformation()
    {
        if (empty($this->packages)) {
            $this->packages = $this->_collectListPackageInformation();
        }

        return $this->packages;
    }

    /**
     * @return array
     */
    public function collectListAvailablePackageInformation()
    {
        /**
         * check package exists
         */
        $packages = $this->collectListPackageInformation();

        $items = \App::table('core.core_extension')
            ->select()
            ->toPairs('name', 'id');

        $result = [];

        foreach ($packages as $id => $package) {
            if (empty($items[ $id ])) {
                $result[ $id ] = $package;
            }
        }

        return $result;
    }

    /**
     * @param $listPackage
     */
    public function doInstallPackages($listPackage)
    {
        $packages = $this->collectListPackageInformation();

        $checked = [];

        foreach ($listPackage as $id) {
            if (!empty($packages[ $id ])) {
                $checked[ $id ] = $packages[ $id ];
            }
        }

        foreach ($checked as $id => $item) {
            \App::autoload()
                ->addNamespace($item['namespace'], PICASO_MODULE_DIR . $item['path']);

            $serviceName = sprintf("%s.install_handler", $item['name']);

            $service = \App::service($serviceName);

            if (!$service instanceof ModuleInstallHandler) continue;
            $service->install();
        }
        \App::cacheService()
            ->flush();
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function upgradePackage($name)
    {
        $packages = $this->collectListPackageInformation();
        if (empty($packages[ $name ]))
            return false;

        $item = $packages[ $name ];
        $serviceName = sprintf("%s.install_handler", $item['name']);

        \App::autoload()
            ->addNamespace($item['namespace'], PICASO_MODULE_DIR . $item['path']);

        $service = \App::service($serviceName);

        if (!$service instanceof ModuleInstallHandler)
            return true;

        $service->upgrade();

        return true;

    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function enablePackage($name)
    {
        $packages = $this->collectListPackageInformation();
        if (empty($packages[ $name ]))
            return false;


        $item = $packages[ $name ];
        $serviceName = sprintf("%s.install_handler", $item['name']);

        \App::autoload()
            ->addNamespace($item['namespace'], PICASO_MODULE_DIR . $item['path']);

        $service = \App::service($serviceName);

        if (!$service instanceof ModuleInstallHandler)
            return true;

        $service->enable();

        return true;

    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function disablePackage($name)
    {
        $packages = $this->collectListPackageInformation();
        if (empty($packages[ $name ]))
            return false;

        $item = $packages[ $name ];
        $serviceName = sprintf("%s.install_handler", $item['name']);

        \App::autoload()
            ->addNamespace($item['namespace'], PICASO_MODULE_DIR . $item['path']);

        $service = \App::service($serviceName);

        if (!$service instanceof ModuleInstallHandler)
            return true;

        $service->disable();

        return true;

    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function importPackage($name)
    {
        $packages = $this->collectListPackageInformation();
        if (empty($packages[ $name ]))
            return false;

        $item = $packages[ $name ];
        $serviceName = sprintf("%s.install_handler", $item['name']);

        \App::autoload()
            ->addNamespace($item['namespace'], PICASO_MODULE_DIR . $item['path']);

        $service = \App::service($serviceName);

        if (!$service instanceof ModuleInstallHandler)
            return true;

        $service->install();

        return true;

    }

    /**
     * @param \Core\Model\CoreExtension $extension
     */
    public function export($extension)
    {
        if ($extension->isModule()) {
            $this->exportModule($extension);
        } else if ($extension->isTheme()) {
            $this->exportTheme($extension);
        } else if ($extension->isLibrary()) {

        }
    }

    /**
     * Export a theme
     *
     * @param \Core\Model\CoreExtension $extension
     *
     * @return string
     */
    public function exportTheme($extension)
    {

        $handler = new ThemeInstallHandler();

        $handler->export($extension);
    }

    /**
     * @param \Core\Model\CoreExtension $extension
     *
     * @return bool
     */
    public function exportModule($extension)
    {

        $path = $extension->getInstallPath();


        if (!empty($path))
            include_once PICASO_ROOT_DIR . $path;

        $class = $extension->getInstallHandler();

        if (!empty($class))
            $service = new $class;
        else
            $service = new ModuleInstallHandler();

        if (!$service instanceof ModuleInstallHandler)
            return true;

        $service->export();

        return true;

    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getPackageVersion($name)
    {
        if (empty($this->packages))
            $this->packages = $this->collectListPackageInformation();

        if (empty($this->packages[ $name ]))
            return '1.0.0';

        return $this->packages[ $name ]['version'];
    }

    /**
     *
     */
    public function updateJsBundleConfiguration()
    {
        $container = new SimpleContainer([
            'primary'   => 'primary/main',
            'core'      => 'base/core/main',
            'bootstrap' => 'bootstrap/main',
        ]);

        \App::hook()
            ->notify('onBeforeBuildBundleJS', $container);

        // lookup bundle

        // repair bundle

        $data = array_values($container->all());

        $array = implode(',', array_map(function ($e) {
            return '\'' . $e . '\'';
        }, $data));

        $content = 'requirejs([' . $array . '], function(){})';

        $filename = PICASO_STATIC_DIR . '/jscript/jsmain.js';

        file_put_contents($filename, $content);
    }

}