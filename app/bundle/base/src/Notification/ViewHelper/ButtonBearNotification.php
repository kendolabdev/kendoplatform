<?php
namespace Notification\ViewHelper;

/**
 * Class ButtonBearNotification
 *
 * @package Notification\ViewHelper
 */
class ButtonBearNotification
{

    /**
     * @return string
     */
    public function __invoke()
    {
        if (!\App::auth()->logged()) return '';

        $number = \App::notification()
            ->getUnmitigatedNotificationCount();

        return \App::viewHelper()->partial('base/notification/button/bear-notification', [
            'number' => $number,
        ]);
    }
}