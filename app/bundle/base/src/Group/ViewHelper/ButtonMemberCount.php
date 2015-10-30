<?php
namespace Group\ViewHelper;

use Group\Model\Group;

/**
 * Class ButtonMemberCount
 *
 * @package Group\ViewHelper
 */
class ButtonMemberCount
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    function __invoke($item)
    {
        if (!$item instanceof Group) return '';

        return '';
    }

}