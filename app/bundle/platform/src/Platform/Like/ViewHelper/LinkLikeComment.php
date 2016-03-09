<?php

namespace Platform\Like\ViewHelper;

/**
 * Class LinkLikeComment
 *
 * @package Like\ViewHelper
 */
class LinkLikeComment
{

    /**
     * @param      $item
     * @param null $isLiked
     *
     * @return string
     */
    function __invoke($item, $isLiked = null)
    {
        if ($isLiked === null && app()->auth()->logged()) {
            $isLiked = app()->likeService()->isLiked(app()->auth()->getViewer(), $item);
        }

        return strtr('<a role="button" data-toggle="like-comment-toggle" data-object=\':obj\'>:text</a>', [
            ':obj'  => $item->toTokenJson(),
            ':text' => $isLiked ? app()->text('core.unlike') : app()->text('core.like'),
        ]);
    }
}