<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_extension`
 */

namespace Core\Model;

/**
 */
use Picaso\Model;

/**
 * Class CoreExtension
 *
 * @package Core\Model
 */
class CoreExtension extends Model
{
    /**
     * @return bool
     */
    public function canUpgrade()
    {
        $version = \App::core()
            ->extension()
            ->getPackageVersion($this->getName());

        return version_compare($this->getVersion(), $version, '<');
    }

    /**
     * @return bool
     */
    public function canDisable()
    {
        return ($this->isSystem() == false) and ($this->isActive() == true);
    }

    /**
     * @return bool
     */
    public function canEnable()
    {
        return $this->isActive() == false;
    }

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('id', $value);
    }

    /**
     * @return null|string
     */
    public function getExtensionType()
    {
        return $this->__get('extension_type');
    }

    /**
     * @param $value
     */
    public function setExtensionType($value)
    {
        $this->__set('extension_type', $value);
    }

    /**
     * @return null|string
     */
    public function getLoadOrder()
    {
        return $this->__get('load_order');
    }

    /**
     * @param $value
     */
    public function setLoadOrder($value)
    {
        $this->__set('load_order', $value);
    }

    /**
     * @return null|string
     */
    public function getPath()
    {
        return $this->__get('path');
    }

    /**
     * @param $value
     */
    public function setPath($value)
    {
        $this->__set('path', $value);
    }

    /**
     * @return null|string
     */
    public function isActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value)
    {
        $this->__set('is_active', $value);
    }

    /**
     * @return null|string
     */
    public function isSystem()
    {
        return $this->__get('is_system');
    }

    /**
     * @return null|string
     */
    public function getSystem()
    {
        return $this->__get('is_system');
    }

    /**
     * @param $value
     */
    public function setSystem($value)
    {
        $this->__set('is_system', $value);
    }

    /**
     * @return null|string
     */
    public function getNamespace()
    {
        return $this->__get('namespace');
    }

    /**
     * @param $value
     */
    public function setNamespace($value)
    {
        $this->__set('namespace', $value);
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', $value);
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->__get('title');
    }

    /**
     * @param $value
     */
    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    /**
     * @return null|string
     */
    public function getAuthor()
    {
        return $this->__get('author');
    }

    /**
     * @param $value
     */
    public function setAuthor($value)
    {
        $this->__set('author', $value);
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->__get('description');
    }

    /**
     * @param $value
     */
    public function setDescription($value)
    {
        $this->__set('description', $value);
    }

    /**
     * @return null|string
     */
    public function getVersion()
    {
        return $this->__get('version');
    }

    /**
     * @param $value
     */
    public function setVersion($value)
    {
        $this->__set('version', $value);
    }

    /**
     * @return null|string
     */
    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

    /**
     * @return null|string
     */
    public function getModifiedAt()
    {
        return $this->__get('modified_at');
    }

    /**
     * @param $value
     */
    public function setModifiedAt($value)
    {
        $this->__set('modified_at', $value);
    }

    /**
     * @return \Core\Model\CoreExtensionTable
     */
    public function table()
    {
        return \App::table('core.core_extension');
    }
    //END_TABLE_GENERATOR
}