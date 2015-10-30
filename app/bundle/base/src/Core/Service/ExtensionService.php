<?php
namespace Core\Service;

use Core\Model\CoreExtension;
use Picaso\Application\InstallHandler;

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

            if (!$service instanceof InstallHandler) continue;
            $service->import();
        }
        \App::cache()
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

        if (!$service instanceof InstallHandler)
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

        if (!$service instanceof InstallHandler)
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

        if (!$service instanceof InstallHandler)
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

        if (!$service instanceof InstallHandler)
            return true;

        $service->import();

        return true;

    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function exportPackage($name)
    {
        $packages = $this->collectListPackageInformation();
        if (empty($packages[ $name ]))
            return false;

        $item = $packages[ $name ];
        $serviceName = sprintf("%s.install_handler", $item['name']);

        \App::autoload()
            ->addNamespace($item['namespace'], PICASO_MODULE_DIR . $item['path']);

        $service = \App::service($serviceName);

        if (!$service instanceof InstallHandler)
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


}