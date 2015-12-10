<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_layout_support_block`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class SupportBlock
 * @package Platform\Layout\Model
 */
class SupportBlock extends Model{
    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getBlockName();
    }


    /**
     * @param array $data
     *
     * @return string
     */
    public function renderForEdit($data = [])
    {
        $class = $this->getEditorClass();

        $obj = new $class;

        return $obj->render($this, $data);
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('support_block_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('support_block_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSupportBlockId(){
       return $this->__get('support_block_id');
    }

    /**
     * @param $value
     */
    public function setSupportBlockId($value){
       $this->__set('support_block_id', $value);
    }

    /**
     * @return null|string
     */
    public function getBlockName(){
       return $this->__get('block_name');
    }

    /**
     * @param $value
     */
    public function setBlockName($value){
       $this->__set('block_name', $value);
    }

    /**
     * @return null|string
     */
    public function getBlockClass(){
       return $this->__get('block_class');
    }

    /**
     * @param $value
     */
    public function setBlockClass($value){
       $this->__set('block_class', $value);
    }

    /**
     * @return null|string
     */
    public function getBasePath(){
       return $this->__get('base_path');
    }

    /**
     * @param $value
     */
    public function setBasePath($value){
       $this->__set('base_path', $value);
    }

    /**
     * @return null|string
     */
    public function getItemPath(){
       return $this->__get('item_path');
    }

    /**
     * @param $value
     */
    public function setItemPath($value){
       $this->__set('item_path', $value);
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
     * @return null|string
     */
    public function getSupportBlockParamsText(){
       return $this->__get('support_block_params_text');
    }

    /**
     * @param $value
     */
    public function setSupportBlockParamsText($value){
       $this->__set('support_block_params_text', $value);
    }

    /**
     * @return null|string
     */
    public function getBlockType(){
       return $this->__get('block_type');
    }

    /**
     * @param $value
     */
    public function setBlockType($value){
       $this->__set('block_type', $value);
    }

    /**
     * @return null|string
     */
    public function getEditorClass(){
       return $this->__get('editor_class');
    }

    /**
     * @param $value
     */
    public function setEditorClass($value){
       $this->__set('editor_class', $value);
    }

    /**
     * @return \Platform\Layout\Model\SupportBlockTable
     */
    public function table(){
        return \App::table('platform_layout_support_block');
    }
    //END_TABLE_GENERATOR
}