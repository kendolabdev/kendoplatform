<?php
namespace Platform\Core\Service;

use Kendo\Kernel\KernelService;
use Platform\Core\Model\CoreHook;

/**
 * Class HookService
 *
 * @package Core\Service
 */
class HookService extends KernelService
{
    /**
     * @return array
     */
    public function loadAllHooks()
    {
        return app()->cacheService()
            ->get(['HookService', 'load'], 0, function () {
                return $this->loadAllHookFromRepository();
            });
    }

    /**
     * @return array
     */
    public function loadAllHookFromRepository()
    {
        $hooks = [];

        $items = app()->table('platform_core_hook')
            ->select()
            ->where('module_name IN ?', app()->packages()->getActiveModules())
            ->order('event_name, load_order', 1)
            ->toAssocs();

        foreach ($items as $item) {
            $hooks[ $item['event_name'] ][] = $item['service_name'];
        }

        return $hooks;
    }

    /**
     * clean up all hook
     */
    public function cleanupHooks()
    {

        $hooks = $this->loadAllHookFromRepository();

        foreach ($hooks as $eventName => $listService) {
            foreach ($listService as $serviceName) {
                $valid = true;

                if (!app()->hasService($serviceName))
                    $valid = false;

                if ($valid && !method_exists(app()->service($serviceName), $eventName))
                    $valid = false;

                if (!$valid)
                    app()->table('platform_core_hook')
                        ->delete()
                        ->where('service_name=?', $serviceName)
                        ->where('event_name=?', $eventName)
                        ->execute();
            }

        }
    }

    /**
     * Import enabled hook to database
     * Use this method when generate settings
     */
    public function scanHookFromEnableModulesThenImportToRepository()
    {

        $hooks = [];
        $priority = 0;

        $this->cleanupHooks();


        foreach (app()->packages()->getActiveModules() as $key) {

            $serviceKey = "{$key}_event_listener";

            if (!app()->hasService($serviceKey))
                continue;

            $service = app()->instance()->make($serviceKey);

            foreach (get_class_methods(get_class($service)) as $method) {

                if (substr($method, 0, 2) != 'on')
                    continue;

                $hooks[] = [
                    'module_name'  => $key,
                    'event_name'   => $method,
                    'service_name' => $serviceKey,
                    'load_order'   => ++$priority,
                ];
            }

        }

//        $this->insertHook($hooks);
    }

    /**
     * @param $serviceName
     * @param $eventName
     *
     * @return \Platform\Core\Model\CoreHook
     */
    public function findHookByName($serviceName, $eventName)
    {
        return app()->table('platform_core_hook')
            ->select()
            ->where('event_name=?', $eventName)
            ->where('service_name=?', $serviceName)
            ->one();
    }

    /**
     * @param $serviceName
     * @param $eventName
     *
     * @return bool
     */
    public function hasHook($serviceName, $eventName)
    {
        return null != $this->findHookByName($serviceName, $eventName);
    }

    /**
     * @param array $hooks
     */
    public function insertHook($hooks = [])
    {

        foreach ($hooks as $row) {
            if (empty($row['module_name'])) continue;
            if (empty($row['service_name'])) continue;
            if (empty($row['event_name'])) continue;
            if (empty($row['load_order'])) continue;

            if ($this->hasHook($row['service_name'], $row['event_name'])) continue;

            $entry = new CoreHook($row);

            $entry->save();
        }
    }
}