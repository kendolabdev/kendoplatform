<?php
namespace Platform\Group\ViewHelper;

use Platform\Group\Model\Group;
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
        if (!app()->auth()->isUser()) return '';
        // TODO: Implement __invoke() method.

        $viewer = app()->auth()->getViewer();

        if (!$viewer instanceof PosterInterface) return '';


        if (null === $membership) {
            $membership = app()->groupService()->membership()->getMembershipStatus($viewer, $item);
        }

        return app()->viewHelper()->partial('platform/group/button/button-membership', [
            'item'       => $item,
            'membership' => $membership,
        ]);
    }


}