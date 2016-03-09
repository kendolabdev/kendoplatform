<?php
namespace Platform\Invitation\ViewHelper;

/**
 * Class ButtonBearInvitation
 *
 * @package Platform\Invitation\ViewHelper
 */
class ButtonBearInvitation
{
    /**
     * @return string
     */
    public function __invoke()
    {
        if (!app()->auth()->logged()) return '';

        $number = app()->invitationService()
            ->getUnmitigatedNotificationCount();

        return app()->viewHelper()->partial('platform/invitation/button/bear-invitation', [
            'number' => $number,
        ]);
    }
}