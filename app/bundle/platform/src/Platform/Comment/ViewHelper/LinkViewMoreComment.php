<?php

namespace Platform\Comment\ViewHelper;

/**
 * Class LinkViewMoreComment
 *
 * @package Base\Comment\ViewHelper
 */
class LinkViewMoreComment
{
    /**
     * @param        $item
     * @param string $counter
     *
     * @return string
     */
    function __invoke($item, $counter = null)
    {
        if (null == $counter) {
            $counter = min((int)\App::setting('activity', 'comment_limit', 3), $item->getCommentCount());
        }

        return \App::viewHelper()->partial('platform/comment/partial/comment-view-more', [
            'about'   => $item,
            'total'   => $item->getCommentCount(),
            'counter' => $counter,
        ]);
    }
}