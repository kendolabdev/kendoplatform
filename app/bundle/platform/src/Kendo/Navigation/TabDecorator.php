<?php

namespace Kendo\Navigation;

/**
 * Class TabDecorator
 *
 * @package Kendo\Navigation
 */
class TabDecorator extends Decorator
{

    /**
     * @var array
     */
    protected $params = [
        'level0' => 'nav nav-tabs',
        'level1' => '',
        'level2' => '',
        'level3' => '',
        'level4' => '',

    ];

    /**
     * @return string
     */
    public function render()
    {

        if (empty($this->items)) {
            return '';
        }

        $this->prepareActiveItems();

        $content = [];

        foreach ($this->items as $item) {
            try {
                $content[] = $this->renderItem(0, $item);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

        $topClass = $this->params['level0'];

        return '<ul class="' . $topClass . '">' . implode('', $content) . '</ul>';
    }

    /**
     * @param int   $level
     * @param array $item
     *
     * @return string
     */
    public function renderItem($level, $item)
    {

        if ($item['acl']) {
            if (false == \App::aclService()->authorize($item['acl'])) {
                return '';
            }
        }

        $href = null;

        if ($item['type'] == 'separator') {
            return '<li class="divider"></li>';
        } else if ($item['type'] == 'route') {
            $href = \App::routing()->getUrl($item['route'], $item['params']);
        } else if ($item['type'] == 'plugin') {
            $item = \App::navigation()->signal($item['event'], $item);
        }

        $label = \App::i18n()->getTranslator()->text($item['label']);

        // process plugin but return false.
        if (!$item) {
            return '';
        }

        $extra = '';
        $cls = 'ni-' . $item['name'];

        if (!empty($item['class'])) {
            $cls = $item['class'];
        }

        if ($item['active']) {
            $cls .= ' active';
        }

        if (!empty($item['extra'])) {
            $extra = _htmlattrs($item['extra']);
        }

        if (!empty($item['children'])) {
            $childrenHtml = $this->renderChildren($item['children']['level'], $item['children']['items']);

            return '<li class="dropdown">'
            . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'
            . $label
            . '<span class="caret"></span></a>'
            . $childrenHtml .
            '</li>';
        } else {
            return '<li role="presentation" class="' . $cls . '"><a ' . $extra . ' href="' . $href . '">' . $label . '</a></li>';
        }

    }

    /**
     *
     */
    public function prepareActiveItems()
    {
        foreach ($this->items as $index => $item) {
            if (in_array($item['name'], $this->active)) {
                $this->items[ $index ]['active'] = 1;
            }
            if (!empty($item['children'])) {
                foreach ($item['children'] as $sub => $cat) {
                    if (!empty($cat['name']) and in_array($cat['name'], $this->active)) {
                        $this->items[ $index ]['children'][ $sub ]['active'] = 1;
                    }
                }
            }
        }
    }

    /**
     * @param int   $level
     * @param array $items
     *
     * @return string
     */
    public function renderChildren($level, $items)
    {
        if (empty($items)) {
            return '';
        }

        $content = [];

        foreach ($items as $item) {
            $content[] = $this->renderItem($level, $item);
        }

        $class = $this->params[ sprintf('level%d', $level) ];

        return '<ul class="' . $class . '" role="menu">' . implode('', $content) . '</ul>';
    }
}