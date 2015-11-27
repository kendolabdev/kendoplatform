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
        if (!\App::authService()->logged()) return '';

        $number = \App::notificationService()
            ->getUnmitigatedNotificationCount();

        return \App::viewHelper()->partial('base/notification/button/bear-notification', [
            'number' => $number,
        ]);
    }
}