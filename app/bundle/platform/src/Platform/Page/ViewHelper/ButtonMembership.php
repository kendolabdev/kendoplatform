<?php
namespace Platform\Page\ViewHelper;

use Kendo\Content\ContentInterface;

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

        if (!app()->auth()->logged())
            return '';

        if (!$item instanceof ContentInterface)
            return '';

        $viewer = app()->auth()->getViewer();

        $likeStatus = app()->likeService()->getLikeStatus($viewer, $item->getId());

        $followStatus = app()->followService()->getFollowStatus($viewer, $item->getId());

        return app()->viewHelper()->partial('platform/page/button/button-membership', [
            'item'         => $item,
            'likeStatus'   => $likeStatus,
            'followStatus' => $followStatus,
        ]);

    }


}