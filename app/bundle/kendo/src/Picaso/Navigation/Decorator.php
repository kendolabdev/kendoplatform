<?php

namespace Picaso\Navigation;

/**
 * Class Decorator
 *
 * @package Picaso\Navigation
 */
class Decorator
{

    /**
     * @var int
     */
    protected $level = 1;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $navId;

    /**
     * @var string
     */
    protected $parentId;

    /**
     * @var string
     */
    protected $active = ['blog_manage'];

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @param string $navId
     * @param string $parentId
     * @param array  $items
     * @param array  $active
     * @param int    $level
     * @param array  $params
     *
     * @return Decorator
     */
    public function setup($navId, $parentId, $items, $active = [], $level, $params)
    {
        $this->setNavId($navId);
        $this->setLevel($level);
        $this->setParams($params);
        $this->setItems($items);
        $this->setActive($active);
        $this->setParentId($parentId);

        return $this;
    }

    /**
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param string $active
     */
    public function setActive($active)
    {
        if (is_string($active)) {
            $active = [$active];
        }
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function render()
    {

    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        if ($level != null) {
            $this->level = $level;
        }

    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = array_merge($this->params, $params);
    }

    /**
     * @return string
     */
    public function getNavId()
    {
        return $this->navId;
    }

    /**
     * @param string $navId
     */
    public function setNavId($navId)
    {
        $this->navId = $navId;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @param $name
     * @param $defaultValue
     *
     * @return mixed
     */
    public function getParam($name, $defaultValue = null)
    {
        return isset($this->params[ $name ]) ? $this->params[ $name ] : $defaultValue;
    }

    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param string $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }


}