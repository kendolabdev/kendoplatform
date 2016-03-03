<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_section`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\LayoutSection
 *
 * @package Platform\Layout\Model
 */
class LayoutSection extends Model
{
    /**
     * Before insert
     */
    public function _beforeInsert()
    {
        if (empty($this->getSectionId()))
            $this->setSectionId(\App::layouts()->_generateNewId());

        parent::_beforeInsert();
    }

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
    public function getLayoutId()
    {
        return $this->__get('layout_id');
    }

    /**
     * @param $value
     */
    public function setLayoutId($value)
    {
        $this->__set('layout_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionOrder()
    {
        return $this->__get('section_order');
    }

    /**
     * @param $value
     */
    public function setSectionOrder($value)
    {
        $this->__set('section_order', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionActive()
    {
        return $this->__get('section_active');
    }

    /**
     * @param $value
     */
    public function setSectionActive($value)
    {
        $this->__set('section_active', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionType()
    {
        return $this->__get('section_type');
    }

    /**
     * @param $value
     */
    public function setSectionType($value)
    {
        $this->__set('section_type', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionTemplate()
    {
        return $this->__get('section_template');
    }

    /**
     * @param $value
     */
    public function setSectionTemplate($value)
    {
        $this->__set('section_template', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionParamsText()
    {
        return $this->__get('section_params_text');
    }

    /**
     * @param $value
     */
    public function setSectionParamsText($value)
    {
        $this->__set('section_params_text', $value);
    }

    /**
     * @return null|string
     */
    public function getContainerType()
    {
        return $this->__get('container_type');
    }

    /**
     * @param $value
     */
    public function setContainerType($value)
    {
        $this->__set('container_type', $value);
    }

    /**
     * @return \Platform\Layout\Model\LayoutSectionTable
     */
    public function table()
    {
        return \App::table('platform_layout_section');
    }
    //END_TABLE_GENERATOR
}