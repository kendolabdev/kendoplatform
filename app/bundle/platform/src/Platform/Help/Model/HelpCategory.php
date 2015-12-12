<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_help_category`
 */

namespace Platform\Help\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class HelpCategory
 *
 * @package Help\Model
 */
class HelpCategory extends Model implements UniqueId
{

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getCategoryName();
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function getSampleTopic($limit = 5)
    {
        return \App::table('help.help_topic')
            ->select()
            ->where('category_id=?', $this->getId())
            ->where('topic_active=?', 1)
            ->order('topic_sort_order', 1)
            ->limit($limit, 0)
            ->all();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'help.help_category';
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
    public function getCategoryActive()
    {
        return $this->__get('category_active');
    }

    /**
     * @param $value
     */
    public function setCategoryActive($value)
    {
        $this->__set('category_active', $value);
    }

    /**
     * @return null|string
     */
    public function getCategorySortOrder()
    {
        return $this->__get('category_sort_order');
    }

    /**
     * @param $value
     */
    public function setCategorySortOrder($value)
    {
        $this->__set('category_sort_order', $value);
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
     * @return null|string
     */
    public function getCategorySlug()
    {
        return $this->__get('category_slug');
    }

    /**
     * @param $value
     */
    public function setCategorySlug($value)
    {
        $this->__set('category_slug', $value);
    }

    /**
     * @return \Platform\Help\Model\HelpCategoryTable
     */
    public function table()
    {
        return \App::table('platform_help_category');
    }
    //END_TABLE_GENERATOR
}