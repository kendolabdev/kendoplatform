<?php
namespace Photo\ViewHelper;

use Picaso\Content\HasCover;
use Picaso\Content\Poster;

/**
 * Class ButtonUpdateCover
 *
 * @package Photo\ViewHelper
 */
class ButtonUpdateCover
{
    /**
     * @param        $item
     * @param        $value
     * @param string $type
     *
     * @return string
     */
    function __invoke($item, $value = null, $type = 'btn')
    {
        if (!$item instanceof HasCover) return '';
        if (!$item instanceof Poster) return '';
        if (!\App::authService()->logged()) return '';
        if (!$item->viewerIsParent()) return '';

        switch ($type) {
            case 'menu':
            case 'menu-item':
                $script = 'base/photo/partial/menu-item-updatecover';
                break;
            default:
                $script = 'base/photo/partial/button-updatecover';
        }

        return \App::viewHelper()->partial($script, [
            'dataSubject' => $item->toSimpleAttrs(),
        ]);
    }

}