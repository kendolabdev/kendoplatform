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
        if (false == app()->auth()->logged())
            $liked = false;

        if (null === $liked)
            $liked = app()->likeService()->isLiked(app()->auth()->getViewer(), $item);

        return strtr('<a role="button" data-toggle="btn-like" data-object=\':obj\'>:text</a>', [
            ':obj'  => $item->toTokenJson(),
            ':text' => $liked ? app()->text('core.unlike') : app()->text('core.like'),
        ]);
    }
}