<?php
namespace Platform\Notification\ViewHelper;

/**
 * Class ButtonBearNotification
 *
 * @package Platform\Notification\ViewHelper
 */
class ButtonBearNotification
{

    /**
     * @return string
     */
    public function __invoke()
    {
        if (!app()->auth()->logged()) return '';

        $number = app()->notificationService()
            ->getUnmitigatedNotificationCount();

        return app()->viewHelper()->partial('platform/notification/button/bear-notification', [
            'number' => $number,
        ]);
    }
}