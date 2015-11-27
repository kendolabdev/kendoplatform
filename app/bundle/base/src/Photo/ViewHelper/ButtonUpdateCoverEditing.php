<?php
namespace Photo\ViewHelper;

use Picaso\Content\HasCover;
use Picaso\Content\Poster;

/**
 * Class ButtonUpdateCoverEditing
 *
 * @package Photo\ViewHelper
 */
class ButtonUpdateCoverEditing
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


        return \App::viewHelper()->partial('base/photo/partial/button-updatecover-editing', [
            'dataSubject' => $item->toSimpleAttrs(),
        ]);
    }

}