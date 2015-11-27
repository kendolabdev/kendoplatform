<?php

namespace User\ViewHelper;

use Picaso\Content\Poster;

/**
 * Class ButtonMemberCount
 *
 * @package User\ViewHelper
 */
class ButtonMemberCount
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    function __invoke($user, $count = null)
    {
        if (!$user instanceof Poster) return '';

        // count friend of user.
        if (null == $count) {
            $count = \App::relationService()->getMemberCount($user);
        }

        if ($count == 0) {
            return '';
        }

        return strtr('<a class="user-friends-count" role="button" href=":href">:text</a>', [
            ':text' => \App::text('user.number_friends', ['$number' => $count], $count),
            ':href' => $user->toHref(['stuff' => '/friends']),
        ]);
    }

}