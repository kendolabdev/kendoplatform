<?php

namespace Follow\ViewHelper;

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
        if (!\App::authService()->logged()) return '';
        if (!\App::aclService()->pass($item, 'activity.follow')) return '';
        if (\App::authService()->getId() == $item->getId()) return '';

        $poster = \App::authService()->getViewer();

        if (null === $following) {
            $following = \App::followService()->getFollowStatus($poster, $item->getId());
        }

        $script = 'base/follow/partial/button-follow';

        if ($ctx == 'menu')
            $script = 'base/follow/partial/menu-item-follow';

        return \App::viewHelper()->partial($script, [
            'item'      => $item,
            'following' => $following,
            'attrs'     => ['id' => $item->getId(), 'type' => $item->getType()],
        ]);
    }
}