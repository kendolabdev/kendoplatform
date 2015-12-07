<?php

namespace User\ViewHelper;

/**
 * Class ButtonBearAccount
 *
 * @package User\ViewHelper
 */
class ButtonBearAccount
{

    /**
     * @return string
     */
    public function __invoke()
    {
        if (!\App::authService()->logged()) return '';

        return \App::viewHelper()->partial('base/user/button/bear-account', []);
    }
}