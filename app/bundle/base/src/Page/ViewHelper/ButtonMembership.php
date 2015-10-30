<?php
namespace Page\ViewHelper;

use Picaso\Content\Content;

/**
 * Class ButtonMembership
 *
 * @package Page\ViewHelper
 */
class ButtonMembership
{
    /**
     * @param $item
     *
     * @return string
     */
    function __invoke($item)
    {

        if (!\App::auth()->logged())
            return '';

        if (!$item instanceof Content)
            return '';

        $viewer = \App::auth()->getViewer();

        $likeStatus = \App::like()->getLikeStatus($viewer, $item->getId());

        $followStatus = \App::follow()->getFollowStatus($viewer, $item->getId());

        return \App::viewHelper()->partial('base/page/button/button-membership', [
            'item'         => $item,
            'likeStatus'   => $likeStatus,
            'followStatus' => $followStatus,
        ]);

    }


}