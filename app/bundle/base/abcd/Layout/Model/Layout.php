<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_layout`
 */

namespace Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class Layout
 *
 * @package Layout\Model
 */
class Layout extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('layout_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('layout_id', $value);
    }

    /**
     * @return null|string
     */
    public function getLayoutId(){
       return $this->__get('layout_id');
    }

    /**
     * @param $value
     */
    public function setLayoutId($value){
       $this->__set('layout_id', $value);
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
     * @return \Layout\Model\LayoutTable
     */
    public function table(){
        return \App::table('layout');
    }
    //END_TABLE_GENERATOR
}