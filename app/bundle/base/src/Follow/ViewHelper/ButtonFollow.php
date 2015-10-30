<?php

namespace Follow\ViewHelper;

use Picaso\Content\Poster;

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
        if (!$item instanceof Poster) return '';
        if (!\App::auth()->logged()) return '';
        if (!\App::acl()->pass($item, 'activity.follow')) return '';
        if (\App::auth()->getId() == $item->getId()) return '';

        $poster = \App::auth()->getViewer();

        if (null === $following) {
            $following = \App::follow()->getFollowStatus($poster, $item->getId());
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