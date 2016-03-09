<?php
namespace Platform\User\ViewHelper;

use Platform\User\Model\User;

/**
 * Class ButtonMembership
 *
 * @package Platform\User\ViewHelper
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
        if (!app()->auth()->isUser()) return '';
        if (!app()->aclService()->pass($item, 'user.request_friends')) return '';
        if (app()->auth()->getId() == $item->getId()) return '';


        $viewer = app()->auth()->getViewer();

        $membership = app()->user()->membership()->getMembershipStatus($viewer, $item);

        $script = 'platform/user/button/button-membership';

        return app()->viewHelper()->partial($script, [
            'item'       => $item,
            'membership' => $membership,
            'friend'     => $item,
        ]);
    }
}
