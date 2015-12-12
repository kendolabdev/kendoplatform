<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog_section`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Model;

/**
 * Class CatalogSection
 *
 * @package Platform\Catalog\Model
 */
class CatalogSection extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('section_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('section_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionId()
    {
        return $this->__get('section_id');
    }

    /**
     * @param $value
     */
    public function setSectionId($value)
    {
        $this->__set('section_id', $value);
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
     * @return null|string
     */
    public function getSectionCode()
    {
        return $this->__get('section_code');
    }

    /**
     * @param $value
     */
    public function setSectionCode($value)
    {
        $this->__set('section_code', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionName()
    {
        return $this->__get('section_name');
    }

    /**
     * @param $value
     */
    public function setSectionName($value)
    {
        $this->__set('section_name', $value);
    }

    /**
     * @return \Platform\Catalog\Model\CatalogSectionTable
     */
    public function table()
    {
        return \App::table('platform_catalog_section');
    }
    //END_TABLE_GENERATOR
}