<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_help_topic`
 */

namespace Help\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class HelpTopic
 *
 * @package Help\Model
 */
class HelpTopic extends Model implements UniqueId
{
    /**
     * @param int $limit
     *
     * @return array
     */
    public function getSamplePost($limit = 5)
    {
        return \App::table('help.help_post')
            ->select()
            ->where('topic_id=?', $this->getId())
            ->where('post_active=?', 1)
            ->order('post_sort_order', 1)
            ->limit($limit, 0)
            ->all();
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getTopicTitle();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'help.help_topic';
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return [
            'type' => $this->getType(),
            'id'   => $this->getId(),
        ];
    }

    /**
     * @return null|string
     */
    public function getContent()
    {
        return $this->getTopicDescription();
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->getTopicDescription();
    }
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
     * @return \Help\Model\HelpTopicTable
     */
    public function table(){
        return \App::table('help.help_topic');
    }
    //END_TABLE_GENERATOR
}