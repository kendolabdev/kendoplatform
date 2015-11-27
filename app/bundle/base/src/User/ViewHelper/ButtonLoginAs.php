<?php

namespace User\ViewHelper;

use Picaso\Content\Poster;

/**
 * Class ButtonLoginAs
 *
 * @package User\ViewHelper
 */
class ButtonLoginAs
{

    /**
     * @param Poster $item
     *
     * @return string
     */
    public function __invoke($item)
    {
        if (!$item instanceof Poster)
            return '';

        if (!\App::authService()->logged())
            return '';

        if (!\App::aclService()->authorizeFor(\App::authService()->getUser(), 'is_admin'))
            return '';

        if (\App::authService()->getId() == $item->getId())
            return '';

        return \App::viewHelper()->partial('base/user/button/login-as', ['item' => $item]);
    }
}