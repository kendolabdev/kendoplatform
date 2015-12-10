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

        if (!\App::authService()->logged())
            return '';

        if (!\App::aclService()->authorizeFor(\App::authService()->getUser(), 'is_admin'))
            return '';

        if (\App::authService()->getId() == $item->getId())
            return '';

        return \App::viewHelper()->partial('base/user/button/login-as', ['item' => $item]);
    }
}