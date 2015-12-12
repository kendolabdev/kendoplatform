<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog_plugin`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Model;

/**
 * Class CatalogPlugin
 *
 * @package Platform\Catalog\Model
 */
class CatalogPlugin extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('plugin_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('plugin_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPluginId()
    {
        return $this->__get('plugin_id');
    }

    /**
     * @param $value
     */
    public function setPluginId($value)
    {
        $this->__set('plugin_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPluginName()
    {
        return $this->__get('plugin_name');
    }

    /**
     * @param $value
     */
    public function setPluginName($value)
    {
        $this->__set('plugin_name', $value);
    }

    /**
     * @return null|string
     */
    public function isPredefined()
    {
        return $this->__get('is_predefined');
    }

    /**
     * @return null|string
     */
    public function getPredefined()
    {
        return $this->__get('is_predefined');
    }

    /**
     * @param $value
     */
    public function setPredefined($value)
    {
        $this->__set('is_predefined', $value);
    }

    /**
     * @return null|string
     */
    public function isFormControl()
    {
        return $this->__get('is_form_control');
    }

    /**
     * @return null|string
     */
    public function getFormControl()
    {
        return $this->__get('is_form_control');
    }

    /**
     * @param $value
     */
    public function setFormControl($value)
    {
        $this->__set('is_form_control', $value);
    }

    /**
     * @return null|string
     */
    public function getPluginSetting()
    {
        return $this->__get('plugin_setting');
    }

    /**
     * @param $value
     */
    public function setPluginSetting($value)
    {
        $this->__set('plugin_setting', $value);
    }

    /**
     * @return null|string
     */
    public function isMultiple()
    {
        return $this->__get('is_multiple');
    }

    /**
     * @return null|string
     */
    public function getMultiple()
    {
        return $this->__get('is_multiple');
    }

    /**
     * @param $value
     */
    public function setMultiple($value)
    {
        $this->__set('is_multiple', $value);
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
     * @return \Platform\Catalog\Model\CatalogPluginTable
     */
    public function table()
    {
        return \App::table('platform_catalog_plugin');
    }
    //END_TABLE_GENERATOR
}