<?php

namespace Platform\Message\ViewHelper;

use Platform\User\Model\User;

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
        if (!app()->auth()->logged()) return '';
        if (!app()->aclService()->pass($item, 'message.send_message')) return '';
        if (app()->auth()->getId() == $item->getId()) return '';

        switch ($type) {
            case 'menu':
            case 'menu-item':
                $script = 'platform/message/partial/menu-item-message';
                break;
            default:
                $script = 'platform/message/partial/button-message';
        }


        return app()->viewHelper()->partial($script, [
            'item'  => $item,
            'attrs' => ['id' => $item->getId(), 'type' => $item->getType()],
        ]);
    }

}