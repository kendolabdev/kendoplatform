<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_page`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\LayoutPage
 *
 * @package Platform\Layout\Model
 */
class LayoutPage extends Model
{
    /**
     * @return string
     */
    public function getTitle()
    {
        return \App::text('page_title.' . $this->getPageName());
    }

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('page_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('page_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPageId()
    {
        return $this->__get('page_id');
    }

    /**
     * @param $value
     */
    public function setPageId($value)
    {
        $this->__set('page_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPageName()
    {
        return $this->__get('page_name');
    }

    /**
     * @param $value
     */
    public function setPageName($value)
    {
        $this->__set('page_name', $value);
    }

    /**
     * @return null|string
     */
    public function getParentPageName()
    {
        return $this->__get('parent_page_name');
    }

    /**
     * @param $value
     */
    public function setParentPageName($value)
    {
        $this->__set('parent_page_name', $value);
    }

    /**
     * @return null|string
     */
    public function getModuleName()
    {
        return $this->__get('module_name');
    }

    /**
     * @param $value
     */
    public function setModuleName($value)
    {
        $this->__set('module_name', $value);
    }

    /**
     * @return null|string
     */
    public function getItemModuleName()
    {
        return $this->__get('item_module_name');
    }

    /**
     * @param $value
     */
    public function setItemModuleName($value)
    {
        $this->__set('item_module_name', $value);
    }

    /**
     * @return null|string
     */
    public function getPageParamsText()
    {
        return $this->__get('page_params_text');
    }

    /**
     * @param $value
     */
    public function setPageParamsText($value)
    {
        $this->__set('page_params_text', $value);
    }

    /**
     * @return null|string
     */
    public function getPageCondition()
    {
        return $this->__get('page_condition');
    }

    /**
     * @param $value
     */
    public function setPageCondition($value)
    {
        $this->__set('page_condition', $value);
    }

    /**
     * @return null|string
     */
    public function isAdmin()
    {
        return $this->__get('is_admin');
    }

    /**
     * @return null|string
     */
    public function getAdmin()
    {
        return $this->__get('is_admin');
    }

    /**
     * @param $value
     */
    public function setAdmin($value)
    {
        $this->__set('is_admin', $value);
    }

    /**
     * @return null|string
     */
    public function getBasePath()
    {
        return $this->__get('base_path');
    }

    /**
     * @param $value
     */
    public function setBasePath($value)
    {
        $this->__set('base_path', $value);
    }

    /**
     * @return null|string
     */
    public function getItemPath()
    {
        return $this->__get('item_path');
    }

    /**
     * @param $value
     */
    public function setItemPath($value)
    {
        $this->__set('item_path', $value);
    }

    /**
     * @return \Platform\Layout\Model\LayoutPageTable
     */
    public function table()
    {
        return \App::table('platform_layout_page');
    }
    //END_TABLE_GENERATOR
}