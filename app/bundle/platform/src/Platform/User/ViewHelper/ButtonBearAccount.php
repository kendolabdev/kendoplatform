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
        if (!app()->auth()->logged()) return '';

        return app()->viewHelper()->partial('platform/user/button/bear-account', []);
    }
}