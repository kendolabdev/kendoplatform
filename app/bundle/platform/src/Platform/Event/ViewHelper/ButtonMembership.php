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
        if (!app()->auth()->isUser()) return '';
        // TODO: Implement __invoke() method.

        $viewer = app()->auth()->getViewer();

        if (!$viewer instanceof PosterInterface) return '';

        if (null === $membership) {
            $membership = app()->groupService()->membership()->getMembershipStatus($viewer, $item);
        }

        return app()->viewHelper()->partial('platform/event/partial/button-membership', [
            'item'       => $item,
            'membership' => $membership,
        ]);
    }


}