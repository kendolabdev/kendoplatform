<?php
namespace Event\ViewHelper;

use Event\Model\Event;
use Picaso\Content\Poster;

/**
 * Class ButtonMembership
 *
 * @package Event\ViewHelper
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
        if (!$item instanceof Event) return '';
        if (!\App::authService()->isUser()) return '';
        // TODO: Implement __invoke() method.

        $viewer = \App::authService()->getViewer();

        if (!$viewer instanceof Poster) return '';

        if (null === $membership) {
            $membership = \App::groupService()->membership()->getMembershipStatus($viewer, $item);
        }

        return \App::viewHelper()->partial('base/event/partial/button-membership', [
            'item'       => $item,
            'membership' => $membership,
        ]);
    }


}