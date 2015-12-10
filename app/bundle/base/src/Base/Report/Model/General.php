<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_report_general`
 */

namespace Base\Report\Model;

/**
 */
use Kendo\Model;

/**
 * Class General
 * @package Base\Report\Model
 */
class General extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('general_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('general_id', $value);
    }

    /**
     * @return null|string
     */
    public function getGeneralId(){
       return $this->__get('general_id');
    }

    /**
     * @param $value
     */
    public function setGeneralId($value){
       $this->__set('general_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPosterId(){
       return $this->__get('poster_id');
    }

    /**
     * @param $value
     */
    public function setPosterId($value){
       $this->__set('poster_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPosterType(){
       return $this->__get('poster_type');
    }

    /**
     * @param $value
     */
    public function setPosterType($value){
       $this->__set('poster_type', $value);
    }

    /**
     * @return null|string
     */
    public function getCreatedAt(){
       return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value){
       $this->__set('created_at', $value);
    }

    /**
     * @return null|string
     */
    public function getMessage(){
       return $this->__get('message');
    }

    /**
     * @param $value
     */
    public function setMessage($value){
       $this->__set('message', $value);
    }

    /**
     * @return \Base\Report\Model\GeneralTable
     */
    public function table(){
        return \App::table('base_report_general');
    }
    //END_TABLE_GENERATOR
}