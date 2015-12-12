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
        if (!\App::authService()->logged()) return '';

        $number = \App::invitationService()
            ->getUnmitigatedNotificationCount();

        return \App::viewHelper()->partial('platform/invitation/button/bear-invitation', [
            'number' => $number,
        ]);
    }
}