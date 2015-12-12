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

        if (!\App::authService()->logged())
            return '';

        if (!$item instanceof ContentInterface)
            return '';

        $viewer = \App::authService()->getViewer();

        $likeStatus = \App::likeService()->getLikeStatus($viewer, $item->getId());

        $followStatus = \App::followService()->getFollowStatus($viewer, $item->getId());

        return \App::viewHelper()->partial('base/page/button/button-membership', [
            'item'         => $item,
            'likeStatus'   => $likeStatus,
            'followStatus' => $followStatus,
        ]);

    }


}