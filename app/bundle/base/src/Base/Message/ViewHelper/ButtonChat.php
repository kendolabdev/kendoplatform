<?php
namespace Base\Message\ViewHelper;

use Kendo\Content\PosterInterface;

/**
 * Class ButtonChat
 *
 * @package Message\ViewHelper
 */
class ButtonChat
{
    /**
     * @param $item
     *
     * @return string
     */
    public function __invoke($item)
    {

        if (!$item instanceof PosterInterface) return '';
        if (!\App::authService()->logged()) return '';
        if (!\App::aclService()->pass($item, 'message.chat')) return '';

        return \App::viewHelper()->partial('base/message/partial/button-chat', [
            'item'  => $item,
            'attrs' => ['id' => $item->getId(), 'type' => $item->getType()],
        ]);
    }

}