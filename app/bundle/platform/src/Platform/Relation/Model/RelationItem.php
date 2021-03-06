<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_relation_item`
 */

namespace Platform\Relation\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\RelationItem
 *
 * @package Platform\Relation\Model
 */
class RelationItem extends Model
{
    /**
     * Events
     * onBeforeInsertRelationItem
     * onBeforeDeleteRelationItem
     * onAfterInsertRelationItem
     * onAfterDeleteRelationItem
     *
     * @var string
     */
    protected $_signalKey = 'RelationItem';

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getPoster()
    {
        return app()->find($this->getPosterType(), $this->getPosterId());
    }

    /**
     * @return \Platform\Core\Model\Relation
     */
    public function getRelation()
    {
        return app()->table('core.relation')
            ->findById($this->getRelationId());
    }

    //START_TABLE_GENERATOR

    
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
     * @return \Platform\Relation\Model\RelationItemTable
     */
    public function table(){
        return app()->table('platform_relation_item');
    }
    //END_TABLE_GENERATOR
}