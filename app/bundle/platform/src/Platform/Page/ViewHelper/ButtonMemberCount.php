<?php
namespace Platform\Page\ViewHelper;

use Platform\Page\Model\Page;


/**
 * Class ButtonMemberCount
 *
 * @package Page\ViewHelper
 */
class ButtonMemberCount
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param mixed $item
     *
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    function __invoke($item)
    {
        if (!$item instanceof Page) return '';

        return '';
    }

}