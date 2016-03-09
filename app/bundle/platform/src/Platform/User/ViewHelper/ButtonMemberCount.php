<?php

namespace Platform\User\ViewHelper;

use Kendo\Content\PosterInterface;

/**
 * Class ButtonMemberCount
 *
 * @package Platform\User\ViewHelper
 */
class ButtonMemberCount
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param mixed $user
     * @param mixed $count
     *
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    function __invoke($user, $count = null)
    {
        if (!$user instanceof PosterInterface) return '';

        // count friend of user.
        if (null == $count) {
            $count = app()->relation()->getMemberCount($user);
        }

        if ($count == 0) {
            return '';
        }

        return strtr('<a class="user-friends-count" role="button" href=":href">:text</a>', [
            ':text' => app()->text('user.number_friends', ['$number' => $count], $count),
            ':href' => $user->toHref(['any' => '/friends']),
        ]);
    }

}