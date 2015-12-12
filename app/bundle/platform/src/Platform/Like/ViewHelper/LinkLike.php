<?php

namespace Platform\Like\ViewHelper;

/**
 * Class LinkLike
 *
 * @package Like\ViewHelper
 */
class LinkLike
{
    /**
     * @param      $item
     * @param null $liked
     *
     * @return string
     */
    function __invoke($item, $liked = null)
    {
        if (false == \App::authService()->logged())
            $liked = false;

        if (null === $liked)
            $liked = \App::likeService()->isLiked(\App::authService()->getViewer(), $item);

        return strtr('<a role="button" data-toggle="btn-like" data-object=\':obj\'>:text</a>', [
            ':obj'  => $item->toTokenJson(),
            ':text' => $liked ? \App::text('core.unlike') : \App::text('core.like'),
        ]);
    }
}