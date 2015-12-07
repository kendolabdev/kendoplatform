<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_social_service`
 */

namespace Social\Model;

/**
 */
use Kendo\Model;

/**
 * Class SocialService
 *
 * @package Social\Model
 */
class SocialService extends Model
{
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->__get('name');
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function getConnectUrl($params = [])
    {
        $params['service'] = $this->getId();

        return \App::routingService()->getUrl('connect', $params);
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return '';
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('id', $value);
    }

    /**
     * @return null|string
     */
    public function getName(){
       return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value){
       $this->__set('name', $value);
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
    public function getSortOrder(){
       return $this->__get('sort_order');
    }

    /**
     * @param $value
     */
    public function setSortOrder($value){
       $this->__set('sort_order', $value);
    }

    /**
     * @return null|string
     */
    public function getSettingForm(){
       return $this->__get('setting_form');
    }

    /**
     * @param $value
     */
    public function setSettingForm($value){
       $this->__set('setting_form', $value);
    }

    /**
     * @return null|string
     */
    public function getIonIconClass(){
       return $this->__get('ion_icon_class');
    }

    /**
     * @param $value
     */
    public function setIonIconClass($value){
       $this->__set('ion_icon_class', $value);
    }

    /**
     * @return \Social\Model\SocialServiceTable
     */
    public function table(){
        return \App::table('social.social_service');
    }
    //END_TABLE_GENERATOR
}