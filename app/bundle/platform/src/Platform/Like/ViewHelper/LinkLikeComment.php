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
        if ($isLiked === null && \App::authService()->logged()) {
            $isLiked = \App::likeService()->isLiked(\App::authService()->getViewer(), $item);
        }

        return strtr('<a role="button" data-toggle="like-comment-toggle" data-object=\':obj\'>:text</a>', [
            ':obj'  => $item->toTokenJson(),
            ':text' => $isLiked ? \App::text('core.unlike') : \App::text('core.like'),
        ]);
    }
}