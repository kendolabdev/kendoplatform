<?php

namespace Kendo\Settings;

use Kendo\Kernel\KernelServiceAgreement;

/**
 * Class Manager
 *
 * @package Kendo\Setting
 */
class SettingsContainer extends KernelServiceAgreement
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Load all app configuration data
     */
    public function bound()
    {

        $this->data = \App::cacheService()
            ->get(['setting', 'load'], 0, function () {
                return $this->buildFromRepository();
            });
    }

    /**
     * @return array
     */
    public function buildFromRepository()
    {
        $result = [];

        $items = \App::table('platform_setting')
            ->select('c')
            ->join(":platform_setting_action", 'a', 'a.action_id=c.action_id', null, null)
            ->columns('c.value_text, a.*')
            ->toAssocs();

        foreach ($items as $item) {
            if (empty($result[ $item['action_group'] ])) {
                $result[ $item['action_group'] ] = [];
            }
            $value = json_decode($item['value_text'], 1);
            $result[ $item['action_group'] ][ $item['action_name'] ] = $value['val'];
        }

        return $result;
    }

    /**
     * @param  string $group
     * @param  string $name
     * @param  mixed  $defaultValue
     *
     * @return mixed
     */
    public function get($group, $name = null, $defaultValue = null)
    {
        if (empty($name)) {
            if (isset($this->data[ $group ])) {
                return $this->data[ $group ];
            }
        } else if (isset($this->data[ $group ][ $name ])) {
            return $this->data[ $group ][ $name ];
        }

        return $defaultValue;
    }
}