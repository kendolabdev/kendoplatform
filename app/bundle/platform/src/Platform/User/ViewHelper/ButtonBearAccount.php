<?php

namespace Platform\User\ViewHelper;

/**
 * Class ButtonBearAccount
 *
 * @package Platform\User\ViewHelper
 */
class ButtonBearAccount
{

    /**
     * @return string
     */
    public function __invoke()
    {
        if (!\App::authService()->logged()) return '';

        return \App::viewHelper()->partial('platform/user/button/bear-account', []);
    }
}