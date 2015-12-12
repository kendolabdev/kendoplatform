<?php

namespace Platform\Comment\ViewHelper;

/**
 * Class LinkComment
 *
 * @package Base\Comment\ViewHelper
 */
class LinkComment
{

    /**
     * @param $item
     *
     * @return string
     */
    function __invoke($item)
    {
        return strtr('<a role="button" data-toggle="btn-comment" data-object=\':obj\'>:text</a>', [
            ':obj'  => $item->toTokenJson(),
            ':text' => \App::text('core.comment'),
        ]);
    }
}