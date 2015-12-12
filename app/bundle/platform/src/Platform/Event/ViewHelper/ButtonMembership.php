<?php
namespace Platform\Event\ViewHelper;

use Platform\Event\Model\Event;
use Kendo\Content\PosterInterface;

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

        if (!$viewer instanceof PosterInterface) return '';

        if (null === $membership) {
            $membership = \App::groupService()->membership()->getMembershipStatus($viewer, $item);
        }

        return \App::viewHelper()->partial('base/event/partial/button-membership', [
            'item'       => $item,
            'membership' => $membership,
        ]);
    }


}