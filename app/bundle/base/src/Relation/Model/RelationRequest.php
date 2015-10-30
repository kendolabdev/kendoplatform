<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_relation_request`
 */

namespace Relation\Model;

/**
 */
use Picaso\Model;

/**
 * Class RelationRequest
 *
 * @package Relation\Model
 */
class RelationRequest extends Model
{
    /**
     * onBeforeInsertMembershipRequest
     * onBeforeDeleteMembershipRequest
     * onAfterInsertMembershipRequest
     * onAfterDeleteMembershipRequest
     *
     * @var string
     */
    protected $_signalKey = 'RelationRequest';

    /**
     * @return \Picaso\Content\Poster
     */
    public function getParent()
    {
        return \App::find($this->getParentType(), $this->getParentId());
    }

    /**
     * @return \Picaso\Content\Poster
     */
    public function getPoster()
    {
        return \App::find($this->getPosterType(), $this->getPosterId());
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getParentId(){
       return $this->__get('parent_id');
    }

    /**
     * @param $value
     */
    public function setParentId($value){
       $this->__set('parent_id', $value);
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
    public function getParentType(){
       return $this->__get('parent_type');
    }

    /**
     * @param $value
     */
    public function setParentType($value){
       $this->__set('parent_type', $value);
    }

    /**
     * @return null|string
     */
    public function getRelationType(){
       return $this->__get('relation_type');
    }

    /**
     * @param $value
     */
    public function setRelationType($value){
       $this->__set('relation_type', $value);
    }

    /**
     * @return null|string
     */
    public function getStatus(){
       return $this->__get('status');
    }

    /**
     * @param $value
     */
    public function setStatus($value){
       $this->__set('status', $value);
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
     * @return \Relation\Model\RelationRequestTable
     */
    public function table(){
        return \App::table('relation.relation_request');
    }
    //END_TABLE_GENERATOR
}