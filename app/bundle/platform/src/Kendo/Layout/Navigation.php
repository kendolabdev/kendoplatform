<?php
namespace Kendo\Layout;

/**
 * Class Navigation
 *
 * @package Kendo\Layout
 */
class Navigation
{
    /**
     * @var string
     */
    protected $_nav;

    /**
     * @var string
     */
    protected $_parentId;

    /**
     * @var array
     */
    protected $_active;

    /**
     * @return string
     */
    public function getNav()
    {
        return $this->_nav;
    }

    /**
     * @param string $nav
     */
    public function setNav($nav)
    {
        $this->_nav = $nav;
    }

    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->_parentId;
    }

    /**
     * @param string $parentId
     */
    public function setParentId($parentId)
    {
        $this->_parentId = $parentId;
    }

    /**
     * @return array
     */
    public function getActive()
    {
        return $this->_active;
    }

    /**
     * @param array $active
     */
    public function setActive($active)
    {
        if (empty($active)) {
            $active = [];
        } else if (is_string($active)) {
            $active = [$active];
        }

        $this->_active = $active;
    }


    /**
     * @param       $navId
     * @param null  $parentId
     * @param array $active
     */
    public function setup($navId, $parentId = null, $active = [])
    {
        $this->setNav($navId);
        $this->setParentId($parentId);
        $this->setActive($active);
    }
}