<?php
namespace Core\Service;

use Core\Model\CoreHook;

/**
 * Class HookService
 *
 * @package Core\Service
 */
class HookService
{
    /**
     * @return array
     */
    public function loadAllHooks()
    {
        return \App::cacheService()
            ->get(['HookService', 'load'], 0, function () {
                return $this->_loadAllHooks();
            });
    }

    /**
     * @return array
     */
    public function _loadAllHooks()
    {
        $hooks = [];

        $items = \App::table('core.core_hook')
            ->select()
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
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

        $hooks = $this->_loadAllHooks();

        foreach ($hooks as $eventName => $listService) {
            foreach ($listService as $serviceName) {
                $valid = true;

                if (!\App::hasService($serviceName))
                    $valid = false;

                if ($valid && !method_exists(\App::service($serviceName), $eventName))
                    $valid = false;

                if (!$valid)
                    \App::table('core.core_hook')
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
    public function scanHookFromEnableModulesThenImportToDatabase()
    {
        $extension = \App::extensions();
        $hooks = [];
        $priority = 0;

        $this->cleanupHooks();


        foreach ($extension->getActiveModuleNames() as $key) {

            $serviceKey = "$key.event_handler";

            if (!\App::hasService($serviceKey))
                continue;

            $service = \App::service($serviceKey);

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

        $this->_importHookToDatabase($hooks);
    }

    /**
     * @param $serviceName
     * @param $eventName
     *
     * @return \Core\Model\CoreHook
     */
    public function findHookByName($serviceName, $eventName)
    {
        return \App::table('core.core_hook')
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
    public function _importHookToDatabase($hooks = [])
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

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListHookByModuleName($moduleList = [])
    {
        return \App::table('core.core_hook')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }
}