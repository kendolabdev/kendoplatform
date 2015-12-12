<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Model;

/**
 * Class Catalog
 *
 * @package Platform\Catalog\Model
 */
class Catalog extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('catalog_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('catalog_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCatalogId()
    {
        return $this->__get('catalog_id');
    }

    /**
     * @param $value
     */
    public function setCatalogId($value)
    {
        $this->__set('catalog_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCatalogCode()
    {
        return $this->__get('catalog_code');
    }

    /**
     * @param $value
     */
    public function setCatalogCode($value)
    {
        $this->__set('catalog_code', $value);
    }

    /**
     * @return null|string
     */
    public function getCatalogName()
    {
        return $this->__get('catalog_name');
    }

    /**
     * @param $value
     */
    public function setCatalogName($value)
    {
        $this->__set('catalog_name', $value);
    }

    /**
     * @return null|string
     */
    public function getContentId()
    {
        return $this->__get('content_id');
    }

    /**
     * @param $value
     */
    public function setContentId($value)
    {
        $this->__set('content_id', $value);
    }

    /**
     * @return \Platform\Catalog\Model\CatalogTable
     */
    public function table()
    {
        return \App::table('platform_catalog');
    }
    //END_TABLE_GENERATOR
}