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
        if (!\App::auth()->logged()) return '';

        return \App::viewHelper()->partial('base/user/button/bear-account', []);
    }
}