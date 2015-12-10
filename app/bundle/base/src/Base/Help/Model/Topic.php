<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_help_topic`
 */

namespace Base\Help\Model;

/**
 */
use Kendo\Model;

/**
 * Class Topic
 * @package Base\Help\Model
 */
class Topic extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('topic_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('topic_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTopicId(){
       return $this->__get('topic_id');
    }

    /**
     * @param $value
     */
    public function setTopicId($value){
       $this->__set('topic_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCategoryId(){
       return $this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setCategoryId($value){
       $this->__set('category_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTopicActive(){
       return $this->__get('topic_active');
    }

    /**
     * @param $value
     */
    public function setTopicActive($value){
       $this->__set('topic_active', $value);
    }

    /**
     * @return null|string
     */
    public function getTopicSortOrder(){
       return $this->__get('topic_sort_order');
    }

    /**
     * @param $value
     */
    public function setTopicSortOrder($value){
       $this->__set('topic_sort_order', $value);
    }

    /**
     * @return null|string
     */
    public function getTopicTitle(){
       return $this->__get('topic_title');
    }

    /**
     * @param $value
     */
    public function setTopicTitle($value){
       $this->__set('topic_title', $value);
    }

    /**
     * @return null|string
     */
    public function getTopicSlug(){
       return $this->__get('topic_slug');
    }

    /**
     * @param $value
     */
    public function setTopicSlug($value){
       $this->__set('topic_slug', $value);
    }

    /**
     * @return null|string
     */
    public function getTopicDescription(){
       return $this->__get('topic_description');
    }

    /**
     * @param $value
     */
    public function setTopicDescription($value){
       $this->__set('topic_description', $value);
    }

    /**
     * @return \Base\Help\Model\TopicTable
     */
    public function table(){
        return \App::table('base_help_topic');
    }
    //END_TABLE_GENERATOR
}