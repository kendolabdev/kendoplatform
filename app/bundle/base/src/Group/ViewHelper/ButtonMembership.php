<?php
namespace Group\ViewHelper;

use Group\Model\Group;
use Kendo\Content\PosterInterface;

/**
 * Class ButtonMembership
 *
 * @package Group\ViewHelper
 */
class ButtonMembership
{
    /**
     * @param      $item
     * @param null $membership
     *
     * @return string
     */
    function __invoke($item, $membership = null)
    {
        if (!$item instanceof Group) return '';
        if (!\App::authService()->isUser()) return '';
        // TODO: Implement __invoke() method.

        $viewer = \App::authService()->getViewer();

        if (!$viewer instanceof PosterInterface) return '';


        if (null === $membership) {
            $membership = \App::groupService()->membership()->getMembershipStatus($viewer, $item);
        }

        return \App::viewHelper()->partial('base/group/button/button-membership', [
            'item'       => $item,
            'membership' => $membership,
        ]);
    }


}