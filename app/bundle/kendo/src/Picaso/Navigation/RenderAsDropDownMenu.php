<?php

namespace Picaso\Navigation;

/**
 * Class RenderAsDropDownMenu
 *
 * @package Picaso\Navigation
 */
class RenderAsDropDownMenu extends RenderPlugin
{
    /**
     * @var array
     */
    protected $params = [
        'level0'       => 'nav navbar-nav',
        'level1'       => 'dropdown-menu',
        'level2'       => '',
        'level3'       => '',
        'level4'       => '',
        'max'          => 12,
        'dropdownIcon' => ' <span class="caret"></span>',
        'moreLabel'    => 'More',
    ];

    /**
     * @return string
     */
    public function render()
    {
        if (empty($this->items)) {
            return '';
        }

        $this->prepareItems();
        $this->prepareActiveItems();

        $content = [];
        foreach ($this->items as $item) {
            try {
                $html = $this->renderItem(0, $item);
                if (!empty($html)) {
                    $content[] = $html;
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        if (count($content) > $this->params['max']) {
            // re-process content for the level of now and how to process it as the main feature
        }

        $class = $this->params['level0'];

        return '<ul class="' . $class . '">' . implode('', $content) . '</ul>';
    }

    /**
     * prepare items
     */
    public function prepareItems()
    {
        foreach ($this->items as $offset => $item) {
            if ($item['acl']) {
                if (false == \App::aclService()->authorize($item['acl'])) {
                    unset($this->items[ $offset ]);
                    continue;
                }
            }

            if ($item['type'] == 'event') {
                if (false == ($item = \App::hook()->callback($item['event'], $item))) {
                    unset($this->items[ $offset ]);
                } else {
                    $this->items[ $offset ] = $item;
                }
            }
        }

        $this->items = array_values($this->items);

        if ($this->level == 1 && count($this->items) > $this->params['max']) {
            // rebuild items by the next
            $items = array_slice($this->items, 0, $this->params['max'] - 1);

            $items[] = [
                'name'     => 'more',
                'label'    => $this->params['moreLabel'],
                'type'     => 'static',
                'href'     => '#',
                'acl'      => '',
                'active'   => 0,
                'children' => [
                    'level' => 1,
                    'items' => array_slice($this->items, $this->params['max'] - 1),
                ],
            ];
            $this->items = $items;
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
                foreach ($item['children']['items'] as $sub => $cat) {
                    if (in_array($cat['name'], $this->active)) {
                        $this->items[ $index ]['children']['items'][ $sub ]['active'] = 1;
                    }
                }
            }
        }
    }

    /**
     * @param int   $level
     * @param array $item
     *
     * @return string
     */
    public function renderItem($level, $item)
    {
        if (is_string($item)) {
            return $item;
        }

        $href = null;

        if ($item['type'] == 'separator') {
            return '<li class="divider"></li>';
        } else if ($item['type'] == 'route') {
            $item['href'] = \App::routingService()->getUrl($item['route'], $item['params']);
        }

        if (is_string($item)) {
            return $item;
        }

        if (empty($item['href'])) {
            if (!empty($item['route'])) {
                $href = \App::routingService()->getUrl($item['route'], $item['params']);
            }
        } else {
            $href = $item['href'];
        }

        $label = \App::trans()->text($item['label']);

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

        if (!empty($item['children']) && $level < $this->level) {
            $childrenHtml = $this->renderChildren($item['children']['level'], $item['children']['items']);

            return '<li class="dropdown ' . $cls . '">'
            . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'
            . $label
            . $this->params['dropdownIcon']
            . '</a>'
            . $childrenHtml .
            '</li>';
        } else {
            return '<li class="' . $cls . '"><a ' . $extra . ' href="' . $href . '">' . $label . '</a></li>';
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

        $suffix = '';
        if ($level == 1) {
//            $suffix = '<li class="tail"><div></div></li>';
        }

        $class = $this->params[ sprintf('level%d', $level) ];

        return '<ul class="' . $class . '" role="menu">' . implode('', $content) . $suffix . '</ul>';
    }
}