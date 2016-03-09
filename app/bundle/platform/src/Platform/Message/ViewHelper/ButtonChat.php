<?php
namespace Platform\Message\ViewHelper;

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
        if (!app()->auth()->logged()) return '';
        if (!app()->aclService()->pass($item, 'message.chat')) return '';

        return app()->viewHelper()->partial('platform/message/partial/button-chat', [
            'item'  => $item,
            'attrs' => ['id' => $item->getId(), 'type' => $item->getType()],
        ]);
    }

}