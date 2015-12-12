<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_group_category`
 */

namespace Platform\Group\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class GroupCategory
 *
 * @package Group\Model
 */
class GroupCategory extends Model implements UniqueId
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'group.group_category';
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return ['id' => $this->getId(), 'type' => $this->getType()];
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getCategoryName();
    }

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('category_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCategoryId()
    {
        return $this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setCategoryId($value)
    {
        $this->__set('category_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCategoryName()
    {
        return $this->__get('category_name');
    }

    /**
     * @param $value
     */
    public function setCategoryName($value)
    {
        $this->__set('category_name', $value);
    }

    /**
     * @return \Platform\Group\Model\GroupCategoryTable
     */
    public function table()
    {
        return \App::table('platform_group_category');
    }
    //END_TABLE_GENERATOR
}