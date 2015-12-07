<?php
namespace Setting\Service;

use Kendo\Setting\Manager;
use Setting\Model\Setting;


/**
 * Class SettingService
 *
 * @package Setting\Service
 */
class SettingService implements Manager
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var bool
     */
    private $loaded = false;


    /**
     * @return boolean
     */
    public function isLoaded()
    {
        return $this->loaded;
    }

    /**
     * @param boolean $loaded
     */
    protected function setLoaded($loaded)
    {
        $this->loaded = $loaded;
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (!$this->loaded) {
            $this->load();
        }

        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


    /**
     * @param string  $group
     * @param  string $name
     * @param  mixed  $defaultValue
     *
     * @return mixed
     */
    public function get($group, $name = null, $defaultValue = null)
    {
        if (!$this->loaded) {
            $this->load();
        }

        if (empty($name)) {
            if (isset($this->data[ $group ])) {
                return $this->data[ $group ];
            }
        } else if (isset($this->data[ $group ][ $name ])) {
            return $this->data[ $group ][ $name ];
        }

        return $defaultValue;
    }

    /**
     * @return \Kendo\Db\SqlSelect
     */
    private function getSelect()
    {
        $prefix = \App::db()->getPrefix();

        return \App::table('setting')
            ->select('c')
            ->join("{$prefix}setting_action", 'a', 'a.action_id=c.action_id', null, null)
            ->columns('c.value_text, a.*');
    }


    /**
     * Load all app configuration data
     */
    public function load()
    {
        if ($this->loaded) return;

        $this->data = \App::cacheService()
            ->get(['setting', 'load'], 0, function () {
                return $this->_load();
            });
    }


    /**
     * @return array
     */
    public function _load()
    {
        return $this->_exportListItem($this->getSelect()->toAssocs());
    }

    /**
     * @param array $items
     *
     * @return array
     */
    public function _exportListItem($items)
    {
        $result = [];
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
     * @param string $group
     * @param string $name
     *
     * @return \Setting\Model\Setting
     */
    private function findSetting($group, $name)
    {
        $action = $this->findAction($group, $name);


        if (null == $action) {
            throw new \InvalidArgumentException("Invalid settings [group: $group, name: $name]");
        }

        $setting = \App::table('setting')
            ->select()
            ->where('action_id=?', $action->getId())
            ->one();

        if (null == $setting) {
            $setting = new Setting([
                'action_id'  => $action->getId(),
                'value_text' => '{"val"=>"0"}',
            ]);
            $setting->save();
        }

        return $setting;
    }

    /**
     * @param string $group
     * @param string $name
     *
     * @return \Setting\Model\SettingAction
     */
    private function findAction($group, $name)
    {
        return \App::table('setting.setting_action')
            ->select()
            ->where('action_group=?', (string)$group)
            ->where('action_name=?', (string)$name)
            ->one();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function save($data)
    {
        foreach ($data as $group => $actions) {
            foreach ($actions as $name => $values) {

                if (substr($name, 0, 1) == '_')
                    continue;

                $config = $this->findSetting($group, $name);

                $config->setValueText(json_encode(['val' => $values]));

                $config->save();
            }
        }

        \App::cacheService()
            ->flush();
    }

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getActionListByModuleName($moduleList)
    {
        return \App::table('setting.setting_action')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->columns('module_name, action_group, action_name')
            ->toAssocs();

    }

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getSettingListByModuleName($moduleList)
    {

        $items = $this->getSelect()
            ->where('a.module_name IN ?', $moduleList)
            ->toAssocs();

        return $this->_exportListItem($items);
    }
}