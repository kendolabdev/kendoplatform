<?php

namespace Picaso\Package;

/**
 * Class PlatformInstaller
 *
 * @package Picaso\Package
 */
class PlatformInstaller extends BaseInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'platform';

    /**
     * PlatformInstaller constructor.
     */
    public function __construct()
    {
        $this->moduleList = \App::table('core.core_extension')
            ->select()
            ->where('is_system=?', 1)
            ->where('extension_type=?', 'module')
            ->order('load_order', 1)
            ->fields('name');

        foreach ($this->moduleList as $moduleName)
        {
            if (\App::hasService($installerServiceName = $moduleName . '.installer'))
            {
                $installerService = \App::service($installerServiceName);

                if (!$installerService instanceof ModuleInstaller)
                {
                    throw new \RuntimeException("Module Installer must be child class of PackageInstaller");
                }

                foreach ($installerService->getTableList() as $tableName)
                {
                    $this->tableList[] = $tableName;
                }
                foreach ($installerService->getPathList() as $pathName)
                {
                    $this->pathList[] = $pathName;
                }
            }

        }

        /**
         * export theme lists
         */
        $this->themeList = [];
        $themes = \App::table('core.core_extension')
            ->select()
            ->where('is_system=?', 1)
            ->where('extension_type=?', 'theme')
            ->order('load_order', 1)
            ->fields('name');

        foreach ($themes as $themeName)
        {
            $this->themeList[] = substr($themeName, strlen('theme_'));
        }
    }
}