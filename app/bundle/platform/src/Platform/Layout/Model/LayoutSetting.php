<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_setting`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\LayoutSetting
 *
 * @package Platform\Layout\Model
 */
class LayoutSetting extends Model
{

    /**
     * @param $array
     */
    public function setLayoutSettings($array)
    {
        $this->setSettingParamsText(json_encode($array));
    }

    /**
     * @return array
     */
    public function getLayoutSettings()
    {
        return (array)json_decode($this->getSettingParamsText());
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('setting_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('setting_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSettingId(){
       return $this->__get('setting_id');
    }

    /**
     * @param $value
     */
    public function setSettingId($value){
       $this->__set('setting_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPageId(){
       return $this->__get('page_id');
    }

    /**
     * @param $value
     */
    public function setPageId($value){
       $this->__set('page_id', $value);
    }

    /**
     * @return null|string
     */
    public function getLayoutType(){
       return $this->__get('layout_type');
    }

    /**
     * @param $value
     */
    public function setLayoutType($value){
       $this->__set('layout_type', $value);
    }

    /**
     * @return null|string
     */
    public function getSettingParamsText(){
       return $this->__get('setting_params_text');
    }

    /**
     * @param $value
     */
    public function setSettingParamsText($value){
       $this->__set('setting_params_text', $value);
    }

    /**
     * @return null|string
     */
    public function getScreenSize(){
       return $this->__get('screen_size');
    }

    /**
     * @param $value
     */
    public function setScreenSize($value){
       $this->__set('screen_size', $value);
    }

    /**
     * @return null|string
     */
    public function isActive(){
       return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive(){
       return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value){
       $this->__set('is_active', $value);
    }

    /**
     * @return null|string
     */
    public function getThemeId(){
       return $this->__get('theme_id');
    }

    /**
     * @param $value
     */
    public function setThemeId($value){
       $this->__set('theme_id', $value);
    }

    /**
     * @return \Platform\Layout\Model\LayoutSettingTable
     */
    public function table(){
        return app()->table('platform_layout_setting');
    }
    //END_TABLE_GENERATOR
}