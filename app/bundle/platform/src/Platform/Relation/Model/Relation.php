<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_relation`
 */

namespace Platform\Relation\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class Platform\Relation
 *
 * @package Platform\Relation\Model
 */
class Relation extends Model implements UniqueId
{
    /**
     * @return string
     */
    public function getRelationTitle()
    {
        return '$parent\'s ' . $this->getRelationName();
    }

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getParent()
    {
        return app()->find($this->getParentType(), $this->getParentId());
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('relation_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('relation_id', $value);
    }

    /**
     * @return null|string
     */
    public function getRelationId(){
       return $this->__get('relation_id');
    }

    /**
     * @param $value
     */
    public function setRelationId($value){
       $this->__set('relation_id', $value);
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
    public function getRelationName(){
       return $this->__get('relation_name');
    }

    /**
     * @param $value
     */
    public function setRelationName($value){
       $this->__set('relation_name', $value);
    }

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
    public function getItemCount(){
       return $this->__get('item_count');
    }

    /**
     * @param $value
     */
    public function setItemCount($value){
       $this->__set('item_count', $value);
    }

    /**
     * @return \Platform\Relation\Model\RelationTable
     */
    public function table(){
        return app()->table('platform_relation');
    }
    //END_TABLE_GENERATOR
}