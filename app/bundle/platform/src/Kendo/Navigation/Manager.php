<?php

namespace Kendo\Navigation;
use Kendo\Kernel\KernelService;

/**
 * Class Manager
 *
 * @package Kendo\Navigation
 */
class Manager extends KernelService
{
    /**
     * define max level to load
     */
    CONST MAX_LEVEL = 4;

    /**
     * @var \Kendo\Navigation\NavigationLoaderInterface
     */
    private $loader;

    /**
     * @var array
     */
    private $decorators = [
        'dropdown' => '\Kendo\Navigation\DropdownDecorator',
        'tab'      => '\Kendo\Navigation\TabDecorator',
    ];

    /**
     * @return array
     */
    public function getDecorators()
    {
        return $this->decorators;
    }

    /**
     * @param array $decorators
     */
    public function setDecorators($decorators)
    {
        $this->decorators = $decorators;
    }

    /**
     * @param string $name
     * @param string $class
     */
    public function addDecorator($name, $class)
    {
        $this->decorators[ $name ] = $class;
    }

    /**
     * @param array $plugins
     */
    public function addDecorators($plugins)
    {
        foreach ($plugins as $name => $class) {
            $this->decorators[ $name ] = $class;
        }
    }

    /**
     * @param string $plugin
     * @param string $navId
     * @param string $parentId
     * @param array  $active
     * @param int    $level
     * @param array  $params
     *
     * @return string
     */
    public function render($plugin, $navId, $parentId, $active = [], $level = 1, $params = [])
    {
        $data = app()->cacheService()
            ->get(['nav', $navId, $parentId], 0, function () use ($navId, $parentId) {
                return $this->load($navId, $parentId);
            });

        if (empty($data)) {
            return '';
        }

        return $this->getDecorator($plugin)->setup($navId, $parentId, $data, $active, $level, $params)
            ->render();

    }

    /**
     * @return \Kendo\Navigation\NavigationLoaderInterface
     */
    public function getLoader()
    {
        if (null == $this->loader) {
            $this->loader = $this;
        }

        return $this->loader;
    }

    /**
     * @param \Kendo\Navigation\NavigationLoaderInterface $loader
     */
    public function setLoader($loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param  string $name
     *
     * @return \Kendo\Navigation\Decorator
     * @throws \InvalidArgumentException
     */
    public function getDecorator($name)
    {
        $class = isset($this->decorators[ $name ]) ? $this->decorators[ $name ] : '';

        if (empty($class)) {
            throw new \InvalidArgumentException("Plugin name $name does not support");
        }

        return new $class();
    }

    /**
     * Make navigation data to tree data structure
     *
     * @param string $navigationId
     * @param string $parentId
     *
     * @return array
     */
    public function load($navigationId, $parentId = null)
    {
        $items = [];
        $rows = [];

        $temp = $this->loadFromRepository($navigationId, $parentId);

        // prepare item data
        foreach ($temp as $row) {
            $id = (int)$row->item_id;
            $name = $row->item_name;
            $params = (array)json_decode($row->params_text, true);
            $extra = (array)json_decode($row->extra_text, true);
            $module = (string)$row->module_name;
            $navId = (string)$row->nav_id;

            $rows[ $name ] = [
                'id'       => $id,
                'parent'   => (string)$row->parent_name,
                'name'     => $name,
                'navId'    => $navId,
                'acl'      => (string)$row->acl,
                'event'    => (string)$row->event,
                'module'   => $module,
                'label'    => $row->phrase_name,
                'type'     => (string)$row->item_type,
                'params'   => $params,
                'extra'    => $extra,
                'route'    => (string)$row->route,
                'children' => [],
                'active'   => 0,
            ];
        }

        for ($level = self::MAX_LEVEL; $level > 0; --$level) {
            foreach ($rows as $index => $row) {
                if (empty($row)) {
                    continue;
                }

                $isValid = true;
                $parent = $row['parent'];

                if ($parent == $parentId) {
                    continue;
                }
                $nextParent = $parent;

                for ($i = 0; $i < $level && $isValid; ++$i) {
                    if ($nextParent == $parentId) {
                        if ($i < $level - 1) {
                            $isValid = false;
                        }
                        continue;
                    }

                    if (!isset($rows[ $nextParent ])) {
                        $isValid = false;
                    } else {
                        $nextParent = $rows[ $nextParent ]['parent'];
                    }
                }
                if ($isValid && $nextParent == $parentId && $i == $level) {
                    $rows[ $parent ]['children']['level'] = $level - 1;
                    $rows[ $parent ]['children']['items'][ $index ] = $row;
                    unset($rows[ $index ]);
                }
            }
        }

        foreach ($rows as $index => $row) {
            if (!empty($row) && $row['parent'] == $parentId) {
                $items[ $row['name'] ] = $row;
            }
        }

        return $items;
    }

    /**
     * @param string $navId
     * @param string $parentId
     *
     * @return array
     */
    protected function loadFromRepository($navId, $parentId = null)
    {
        $itemTable = app()->table('platform_navigation_item');

        $select = $itemTable->select('item')
            ->where('item.nav_id = ?', $navId)
            ->where('item.is_active=?', 1)
            ->where('item.module_name IN ?', app()->packages()->getActiveModules())
            ->order('item.sort_order', 1);

        if ($parentId)
            $select->where('item.parent_name=?', (string)$parentId);

        return $select->all();
    }
}