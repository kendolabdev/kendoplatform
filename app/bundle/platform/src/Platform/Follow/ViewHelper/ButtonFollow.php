<?php

namespace Platform\Follow\ViewHelper;

use Kendo\Content\PosterInterface;

/**
 * Class ButtonFollow
 *
 * @package Follow\ViewHelper
 */
class ButtonFollow
{
    /**
     * @param        $item
     * @param null   $following
     * @param string $ctx
     *
     * @return string
     */
    function __invoke($item, $following = null, $ctx = 'btn')
    {
        if (!$item instanceof PosterInterface) return '';
        if (!app()->auth()->logged()) return '';
        if (!app()->aclService()->pass($item, 'activity.follow')) return '';
        if (app()->auth()->getId() == $item->getId()) return '';

        $poster = app()->auth()->getViewer();

        if (null === $following) {
            $following = app()->followService()->getFollowStatus($poster, $item->getId());
        }

        $script = 'platform/follow/partial/button-follow';

        if ($ctx == 'menu')
            $script = 'platform/follow/partial/menu-item-follow';

        return app()->viewHelper()->partial($script, [
            'item'      => $item,
            'following' => $following,
            'attrs'     => ['id' => $item->getId(), 'type' => $item->getType()],
        ]);
    }
}