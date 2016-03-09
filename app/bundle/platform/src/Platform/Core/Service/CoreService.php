<?php

namespace Platform\Core\Service;

use Kendo\Kernel\KernelService;
use Platform\Core\Model\CoreType;

class CoreService extends KernelService
{

    /**
     * @return array
     */
    public function loadTypeOptions()
    {
        return app()->cacheService()
            ->get(['core', 'loadTypeOptions'], 0, function () {
                return $this->loadTypeOptionsFromRepository();
            });
    }

    /**
     * @return array
     */
    public function loadTypeOptionsFromRepository()
    {
        $select = app()->table('platform_core_type')
            ->select();

        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof CoreType) continue;
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getName(),
            ];
        }

        return $options;
    }

    /**
     * @return \Platform\Core\Service\HookService
     */
    public function hook()
    {
        return app()->instance()->make('platform_core_hook');
    }

    /**
     * @return \Platform\Core\Service\ExtensionService
     */
    public function extension()
    {
        return app()->instance()->make('platform_core_extension');
    }


    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListTypeByModuleName($moduleList)
    {
        return app()->table('platform_core_type')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }
}