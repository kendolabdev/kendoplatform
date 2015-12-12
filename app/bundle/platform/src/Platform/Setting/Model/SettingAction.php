<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_setting_action`
 */

namespace Platform\Setting\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\SettingAction
 *
 * @package Platform\Setting\Model
 */
class SettingAction extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('action_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('action_id', $value);
    }

    /**
     * @return null|string
     */
    public function getActionId()
    {
        return $this->__get('action_id');
    }

    /**
     * @param $value
     */
    public function setActionId($value)
    {
        $this->__set('action_id', $value);
    }

    /**
     * @return null|string
     */
    public function getModuleName()
    {
        return $this->__get('module_name');
    }

    /**
     * @param $value
     */
    public function setModuleName($value)
    {
        $this->__set('module_name', $value);
    }

    /**
     * @return null|string
     */
    public function getActionGroup()
    {
        return $this->__get('action_group');
    }

    /**
     * @param $value
     */
    public function setActionGroup($value)
    {
        $this->__set('action_group', $value);
    }

    /**
     * @return null|string
     */
    public function getActionName()
    {
        return $this->__get('action_name');
    }

    /**
     * @param $value
     */
    public function setActionName($value)
    {
        $this->__set('action_name', $value);
    }

    /**
     * @return \Platform\Setting\Model\SettingActionTable
     */
    public function table()
    {
        return \App::table('platform_setting_action');
    }
    //END_TABLE_GENERATOR
}