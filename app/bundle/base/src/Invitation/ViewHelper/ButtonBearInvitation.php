<?php
namespace Invitation\ViewHelper;

/**
 * Class ButtonBearInvitation
 *
 * @package Invitation\ViewHelper
 */
class ButtonBearInvitation
{
    /**
     * @return string
     */
    public function __invoke()
    {
        if (!\App::auth()->logged()) return '';

        $number = \App::invitation()
            ->getUnmitigatedNotificationCount();

        return \App::viewHelper()->partial('base/invitation/button/bear-invitation', [
            'number' => $number,
        ]);
    }
}