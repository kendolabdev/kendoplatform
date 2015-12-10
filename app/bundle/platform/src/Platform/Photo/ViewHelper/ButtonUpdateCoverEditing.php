<?php
namespace Platform\Photo\ViewHelper;

use Kendo\Content\AtomInterface;
use Kendo\Content\PosterInterface;

/**
 * Class ButtonUpdateCoverEditing
 *
 * @package Platform\Photo\ViewHelper
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
        if (!$item instanceof AtomInterface) return '';
        if (!$item instanceof PosterInterface) return '';
        if (!\App::authService()->logged()) return '';
        if (!$item->viewerIsParent()) return '';


        return \App::viewHelper()->partial('base/photo/partial/button-updatecover-editing', [
            'dataSubject' => $item->toSimpleAttrs(),
        ]);
    }

}