<?php

namespace Platform\User\ViewHelper;

use Kendo\Content\PosterInterface;

/**
 * Class ButtonLoginAs
 *
 * @package Platform\User\ViewHelper
 */
class ButtonLoginAs
{

    /**
     * @param PosterInterface $item
     *
     * @return string
     */
    public function __invoke($item)
    {
        if (!$item instanceof PosterInterface)
            return '';

        if (!app()->auth()->logged())
            return '';

        if (!app()->aclService()->authorizeFor(app()->auth()->getUser(), 'is_admin'))
            return '';

        if (app()->auth()->getId() == $item->getId())
            return '';

        return app()->viewHelper()->partial('platform/user/button/login-as', ['item' => $item]);
    }
}