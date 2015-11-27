<?php

namespace Like\ViewHelper;

use Like\Helper\LikeResult;

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

            $item = \App::likeService()->getLikeResult(\App::authService()->getViewer(), $item, 4);
        }

        return $item->getSampleHtml();
    }
}