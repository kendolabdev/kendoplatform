<?php
namespace User\ViewHelper;

use User\Model\User;

/**
 * Class ButtonMembership
 *
 * @package User\ViewHelper
 */
class ButtonMembership
{
    /**
     * @param        $item
     * @param null   $membership
     * @param string $type
     *
     * @return string
     */
    function __invoke($item, $membership = null, $type = 'btn')
    {
        if (!$item instanceof User) return '';
        if (!\App::authService()->isUser()) return '';
        if (!\App::aclService()->pass($item, 'user.request_friends')) return '';
        if (\App::authService()->getId() == $item->getId()) return '';


        $viewer = \App::authService()->getViewer();

        $membership = \App::userService()->membership()->getMembershipStatus($viewer, $item);

        $script = 'base/user/button/button-membership';

        return \App::viewHelper()->partial($script, [
            'item'       => $item,
            'membership' => $membership,
            'friend'     => $item,
        ]);
    }
}
