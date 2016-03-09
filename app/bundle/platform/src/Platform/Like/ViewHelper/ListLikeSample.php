<?php

namespace Platform\Like\ViewHelper;

use Platform\Like\Helper\LikeResult;

/**
 * Class ListLikeSample
 *
 * @package Like\ViewHelper
 */
class ListLikeSample
{
    /**
     * @param        $item
     * @param string $counter
     *
     * @return string
     */
    function __invoke($item, $counter = '#')
    {
        if (!$item instanceof LikeResult) {

            $item = app()->likeService()->getLikeResult(app()->auth()->getViewer(), $item, 4);
        }

        return $item->getSampleHtml();
    }
}