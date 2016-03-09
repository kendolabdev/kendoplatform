<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_relation_type`
 */

namespace Platform\Relation\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\RelationType
 *
 * @package Platform\Relation\Model
 */
class RelationType extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('type_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('type_id', $value);
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
    public function getTypeId(){
       return $this->__get('type_id');
    }

    /**
     * @param $value
     */
    public function setTypeId($value){
       $this->__set('type_id', $value);
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
    public function isBuild(){
       return $this->__get('is_build');
    }

    /**
     * @return null|string
     */
    public function getBuild(){
       return $this->__get('is_build');
    }

    /**
     * @param $value
     */
    public function setBuild($value){
       $this->__set('is_build', $value);
    }

    /**
     * @return null|string
     */
    public function getDescription(){
       return $this->__get('description');
    }

    /**
     * @param $value
     */
    public function setDescription($value){
       $this->__set('description', $value);
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
     * @return \Platform\Relation\Model\RelationTypeTable
     */
    public function table(){
        return app()->table('platform_relation_type');
    }
    //END_TABLE_GENERATOR
}