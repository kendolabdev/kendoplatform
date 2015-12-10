<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_tag_people`
 */

namespace Base\Tag\Model;

/**
 */
use Kendo\Model;

/**
 * Class People
 * @package Base\Tag\Model
 */
class People extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getContentId(){
       return $this->__get('content_id');
    }

    /**
     * @param $value
     */
    public function setContentId($value){
       $this->__set('content_id', $value);
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
    public function getContentType(){
       return $this->__get('content_type');
    }

    /**
     * @param $value
     */
    public function setContentType($value){
       $this->__set('content_type', $value);
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
     * @return \Base\Tag\Model\PeopleTable
     */
    public function table(){
        return \App::table('base_tag_people');
    }
    //END_TABLE_GENERATOR
}