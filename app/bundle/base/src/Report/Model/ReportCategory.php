<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_report_category`
 */

namespace Report\Model;

/**
 */
use Picaso\Content\UniqueId;
use Picaso\Model;

/**
 * Class ReportCategory
 *
 * @package Report\Model
 */
class ReportCategory extends Model implements UniqueId
{

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getCategoryName();
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->getCategoryName();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'report.report_category';
    }

    public function toTokenArray()
    {
        return [
            'id'   => $this->getId(),
            'type' => $this->getType(),
        ];
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('category_id', $value);
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
    public function getCategoryName(){
       return $this->__get('category_name');
    }

    /**
     * @param $value
     */
    public function setCategoryName($value){
       $this->__set('category_name', $value);
    }

    /**
     * @return \Report\Model\ReportCategoryTable
     */
    public function table(){
        return \App::table('report.report_category');
    }
    //END_TABLE_GENERATOR
}