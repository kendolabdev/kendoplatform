<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_navigation`
 */

namespace Navigation\Model;

/**
 */
use Picaso\Model;

/**
 * Class Navigation
 *
 * @package Navigation\Model
 */
class Navigation extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('nav_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('nav_id', $value);
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
    public function isSystem(){
       return $this->__get('is_system');
    }

    /**
     * @return null|string
     */
    public function getSystem(){
       return $this->__get('is_system');
    }

    /**
     * @param $value
     */
    public function setSystem($value){
       $this->__set('is_system', $value);
    }

    /**
     * @return null|string
     */
    public function isAdmin(){
       return $this->__get('is_admin');
    }

    /**
     * @return null|string
     */
    public function getAdmin(){
       return $this->__get('is_admin');
    }

    /**
     * @param $value
     */
    public function setAdmin($value){
       $this->__set('is_admin', $value);
    }

    /**
     * @return null|string
     */
    public function getNavName(){
       return $this->__get('nav_name');
    }

    /**
     * @param $value
     */
    public function setNavName($value){
       $this->__set('nav_name', $value);
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
     * @return \Navigation\Model\NavigationTable
     */
    public function table(){
        return \App::table('navigation');
    }
    //END_TABLE_GENERATOR
}