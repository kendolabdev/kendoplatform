<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_navigation_item`
 */

namespace Platform\Navigation\Model;

/**
 */
use Kendo\Model;

/**
 * Class Item
 * @package Platform\Navigation\Model
 */
class Item extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('item_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('item_id', $value);
    }

    /**
     * @return null|string
     */
    public function getItemId(){
       return $this->__get('item_id');
    }

    /**
     * @param $value
     */
    public function setItemId($value){
       $this->__set('item_id', $value);
    }

    /**
     * @return null|string
     */
    public function getNavId(){
       return $this->__get('nav_id');
    }

    /**
     * @param $value
     */
    public function setNavId($value){
       $this->__set('nav_id', $value);
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
    public function getModuleName(){
       return $this->__get('module_name');
    }

    /**
     * @param $value
     */
    public function setModuleName($value){
       $this->__set('module_name', $value);
    }

    /**
     * @return null|string
     */
    public function getItemName(){
       return $this->__get('item_name');
    }

    /**
     * @param $value
     */
    public function setItemName($value){
       $this->__set('item_name', $value);
    }

    /**
     * @return null|string
     */
    public function getPhraseName(){
       return $this->__get('phrase_name');
    }

    /**
     * @param $value
     */
    public function setPhraseName($value){
       $this->__set('phrase_name', $value);
    }

    /**
     * @return null|string
     */
    public function getParentName(){
       return $this->__get('parent_name');
    }

    /**
     * @param $value
     */
    public function setParentName($value){
       $this->__set('parent_name', $value);
    }

    /**
     * @return null|string
     */
    public function getItemType(){
       return $this->__get('item_type');
    }

    /**
     * @param $value
     */
    public function setItemType($value){
       $this->__set('item_type', $value);
    }

    /**
     * @return null|string
     */
    public function getEvent(){
       return $this->__get('event');
    }

    /**
     * @param $value
     */
    public function setEvent($value){
       $this->__set('event', $value);
    }

    /**
     * @return null|string
     */
    public function getAcl(){
       return $this->__get('acl');
    }

    /**
     * @param $value
     */
    public function setAcl($value){
       $this->__set('acl', $value);
    }

    /**
     * @return null|string
     */
    public function getRoute(){
       return $this->__get('route');
    }

    /**
     * @param $value
     */
    public function setRoute($value){
       $this->__set('route', $value);
    }

    /**
     * @return null|string
     */
    public function getParamsText(){
       return $this->__get('params_text');
    }

    /**
     * @param $value
     */
    public function setParamsText($value){
       $this->__set('params_text', $value);
    }

    /**
     * @return null|string
     */
    public function getQueryText(){
       return $this->__get('query_text');
    }

    /**
     * @param $value
     */
    public function setQueryText($value){
       $this->__set('query_text', $value);
    }

    /**
     * @return null|string
     */
    public function getExtraText(){
       return $this->__get('extra_text');
    }

    /**
     * @param $value
     */
    public function setExtraText($value){
       $this->__set('extra_text', $value);
    }

    /**
     * @return null|string
     */
    public function getIcon(){
       return $this->__get('icon');
    }

    /**
     * @param $value
     */
    public function setIcon($value){
       $this->__set('icon', $value);
    }

    /**
     * @return null|string
     */
    public function getMobileIcon(){
       return $this->__get('mobile_icon');
    }

    /**
     * @param $value
     */
    public function setMobileIcon($value){
       $this->__set('mobile_icon', $value);
    }

    /**
     * @return \Platform\Navigation\Model\ItemTable
     */
    public function table(){
        return \App::table('platform_navigation_item');
    }
    //END_TABLE_GENERATOR
}