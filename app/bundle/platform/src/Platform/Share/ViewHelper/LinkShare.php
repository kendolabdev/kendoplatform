<?php

namespace Platform\Share\ViewHelper;


/**
 * Class LinkShare
 *
 * @package Share\ViewHelper
 */
class LinkShare
{
    /**
     * @param $item
     *
     * @return string
     */
    function __invoke($item)
    {
        return strtr('<a role="button" data-toggle="btn-share" data-object=\':obj\'>:text</a>', [
            ':obj'  => $item->toTokenJson(),
            ':text' => app()->text('core.share'),
        ]);
    }
}