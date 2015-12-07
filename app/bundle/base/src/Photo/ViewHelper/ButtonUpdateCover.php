<?php
namespace Photo\ViewHelper;

use Kendo\Content\AtomInterface;
use Kendo\Content\PosterInterface;

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
        if (!$item instanceof AtomInterface) return '';
        if (!$item instanceof PosterInterface) return '';
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