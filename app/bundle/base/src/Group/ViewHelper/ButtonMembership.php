<?php
namespace Group\ViewHelper;

use Group\Model\Group;
use Picaso\Content\Poster;

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
        if (!\App::auth()->isUser()) return '';
        // TODO: Implement __invoke() method.

        $viewer = \App::auth()->getViewer();

        if (!$viewer instanceof Poster) return '';


        if (null === $membership) {
            $membership = \App::group()->membership()->getMembershipStatus($viewer, $item);
        }

        return \App::viewHelper()->partial('base/group/button/button-membership', [
            'item'       => $item,
            'membership' => $membership,
        ]);
    }


}