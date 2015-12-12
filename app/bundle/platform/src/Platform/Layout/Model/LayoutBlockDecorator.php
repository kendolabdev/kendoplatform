<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_block_decorator`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\LayoutBlockDecorator
 * @package Platform\Layout\Model
 */
class LayoutBlockDecorator extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('id', $value);
    }

    /**
     * @return null|string
     */
    public function getName(){
       return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value){
       $this->__set('name', $value);
    }

    /**
     * @return null|string
     */
    public function getFormClass(){
       return $this->__get('form_class');
    }

    /**
     * @param $value
     */
    public function setFormClass($value){
       $this->__set('form_class', $value);
    }

    /**
     * @return null|string
     */
    public function getDecoratorClass(){
       return $this->__get('decorator_class');
    }

    /**
     * @param $value
     */
    public function setDecoratorClass($value){
       $this->__set('decorator_class', $value);
    }

    /**
     * @return \Platform\Layout\Model\LayoutBlockDecoratorTable
     */
    public function table(){
        return \App::table('platform_layout_block_decorator');
    }
    //END_TABLE_GENERATOR
}