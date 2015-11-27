<?php

namespace Core\Service;

use Core\Model\CoreType;

class CoreService
{

    /**
     * @return array
     */
    public function loadTypeOptions()
    {
        return \App::cacheService()
            ->get(['core', 'loadTypeOptions'], 0, function () {
                return $this->_loadTypeOptions();
            });
    }

    /**
     * @return array
     */
    public function _loadTypeOptions()
    {
        $select = \App::table('core.core_type')
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
     * @return \Core\Service\HookService
     */
    public function hook()
    {
        return \App::service('core.hook');
    }

    /**
     * @return \Core\Service\ExtensionService
     */
    public function extension()
    {
        return \App::service('core.extension');
    }


    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListTypeByModuleName($moduleList)
    {
        return \App::table('core.core_type')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }
}