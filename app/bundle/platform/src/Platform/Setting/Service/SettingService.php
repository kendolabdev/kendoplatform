<?php
namespace Platform\Setting\Service;

use Kendo\Kernel\KernelServiceAgreement;
use Platform\Setting\Model\Setting;


/**
 * Class Platform\SettingService
 *
 * @package Platform\Setting\Service
 */
class SettingService extends KernelServiceAgreement
{
    /**
     * @param string $group
     * @param string $name
     *
     * @return \Platform\Setting\Model\Setting
     */
    private function findSetting($group, $name)
    {
        $action = $this->findAction($group, $name);


        if (null == $action) {
            throw new \InvalidArgumentException("Invalid settings [group: $group, name: $name]");
        }

        $setting = \App::table('platform_setting')
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
     * @return \Platform\Setting\Model\SettingAction
     */
    private function findAction($group, $name)
    {
        return \App::table('platform_setting_action')
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
}