<?php

namespace Message\ViewHelper;

use User\Model\User;

/**
 * Class ButtonMessage
 *
 * @package Message\ViewHelper
 */
class ButtonMessage
{
    /**
     * @param        $item
     * @param        $value
     * @param string $type
     *
     * @return string
     */
    public function __invoke($item, $value = null, $type = 'btn')
    {

        if (!$item instanceof User) return '';
        if (!\App::auth()->logged()) return '';
        if (!\App::acl()->pass($item, 'message.send_message')) return '';
        if (\App::auth()->getId() == $item->getId()) return '';

        switch ($type) {
            case 'menu':
            case 'menu-item':
                $script = 'base/message/partial/menu-item-message';
                break;
            default:
                $script = 'base/message/partial/button-message';
        }


        return \App::viewHelper()->partial($script, [
            'item'  => $item,
            'attrs' => ['id' => $item->getId(), 'type' => $item->getType()],
        ]);
    }

}