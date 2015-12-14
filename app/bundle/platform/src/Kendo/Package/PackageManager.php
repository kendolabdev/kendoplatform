<?php
namespace Kendo\Package;

use Kendo\Kernel\KernelServiceAgreement;

/**
 * Class PackageManager
 *
 * @package Kendo\Package
 */
class PackageManager extends KernelServiceAgreement
{

    /**
     * @var array
     */
    protected $activeBundles = [];

    /**
     * @var array
     */
    protected $activeModules = [];

    /**
     * @var array
     */
    protected $activeThemes = [];

    /**
     * @return array
     */
    public function getActiveBundles()
    {
        return $this->activeBundles;
    }

    /**
     * @param array $activeBundles
     */
    public function setActiveBundles($activeBundles)
    {
        $this->activeBundles = $activeBundles;
    }

    /**
     * @return array
     */
    public function getActiveModules()
    {
        return $this->activeModules;
    }

    /**
     * @param array $activeModules
     */
    public function setActiveModules($activeModules)
    {
        $this->activeModules = $activeModules;
    }

    /**
     * @return array
     */
    public function getActiveThemes()
    {
        return $this->activeThemes;
    }

    /**
     * @param array $activeThemes
     */
    public function setActiveThemes($activeThemes)
    {
        $this->activeThemes = $activeThemes;
    }

    public function bound()
    {
        $this->activeModules = \App::cacheService()
            ->get(['kendo_packake_manager', 'get_active_modules'], 0, function () {
                return $this->app->table('platform_core_extension')
                    ->select()
                    ->where('extension_type=?', 'module')
                    ->where('is_active=?', 1)
                    ->fields('name');
            });

        $this->activeThemes = \App::cacheService()
            ->get(['kendo_packake_manager', 'get_active_themes'], 0, function () {
                return $this->app->table('platform_core_extension')
                    ->select()
                    ->where('extension_type=?', 'theme')
                    ->where('is_active=?', 1)
                    ->fields('name');
            });
    }
}