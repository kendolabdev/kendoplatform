<?php
namespace Platform\Photo\ViewHelper;

use Kendo\Content\AtomInterface;
use Kendo\Content\PosterInterface;

/**
 * Class ButtonUpdateCover
 *
 * @package Platform\Photo\ViewHelper
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
        if (!$item instanceof AtomInterface) return '';
        if (!$item instanceof PosterInterface) return '';
        if (!app()->auth()->logged()) return '';
        if (!$item->viewerIsParent()) return '';

        switch ($type) {
            case 'menu':
            case 'menu-item':
                $script = 'platform/photo/partial/menu-item-updatecover';
                break;
            default:
                $script = 'platform/photo/partial/button-updatecover';
        }

        return app()->viewHelper()->partial($script, [
            'dataSubject' => $item->toSimpleAttrs(),
        ]);
    }

}