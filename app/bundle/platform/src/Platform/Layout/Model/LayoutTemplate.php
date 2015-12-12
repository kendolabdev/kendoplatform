<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_template`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\LayoutTemplate
 *
 * @package Platform\Layout\Model
 */
class LayoutTemplate extends Model
{

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getTemplateName();
    }

    /**
     * @return array
     */
    public function getViewFinderPaths()
    {
        $paths = [
            KENDO_TEMPLATE_DIR . '/' . $this->getId()
        ];

        if ($this->getParentTemplateId()) {
            $paths[] = KENDO_TEMPLATE_DIR . '/' . $this->getParentTemplateId();

        }

        if ($this->getSuperTemplateId()) {
            $paths[] = KENDO_TEMPLATE_DIR . '/' . $this->getSuperTemplateId();
        }

        return $paths;

    }

    /**
     * @return \Platform\Layout\Model\LayoutTemplate
     */
    public function getParentTemplate()
    {
        if (null == $this->getParentTemplateId())
            return null;

        return \App::table('platform_layout_template')
            ->findById($this->getParentTemplateId());
    }

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('template_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('template_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTemplateId()
    {
        return $this->__get('template_id');
    }

    /**
     * @param $value
     */
    public function setTemplateId($value)
    {
        $this->__set('template_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTemplateName()
    {
        return $this->__get('template_name');
    }

    /**
     * @param $value
     */
    public function setTemplateName($value)
    {
        $this->__set('template_name', $value);
    }

    /**
     * @return null|string
     */
    public function getParentTemplateId()
    {
        return $this->__get('parent_template_id');
    }

    /**
     * @param $value
     */
    public function setParentTemplateId($value)
    {
        $this->__set('parent_template_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSuperTemplateId()
    {
        return $this->__get('super_template_id');
    }

    /**
     * @param $value
     */
    public function setSuperTemplateId($value)
    {
        $this->__set('super_template_id', $value);
    }

    /**
     * @return \Platform\Layout\Model\LayoutTemplateTable
     */
    public function table()
    {
        return \App::table('platform_layout_template');
    }
    //END_TABLE_GENERATOR
}