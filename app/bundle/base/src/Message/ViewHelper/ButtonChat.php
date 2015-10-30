<?php
namespace Message\ViewHelper;

use Picaso\Content\Poster;

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

        if (!$item instanceof Poster) return '';
        if (!\App::auth()->logged()) return '';
        if (!\App::acl()->pass($item, 'message.chat')) return '';

        return \App::viewHelper()->partial('base/message/partial/button-chat', [
            'item'  => $item,
            'attrs' => ['id' => $item->getId(), 'type' => $item->getType()],
        ]);
    }

}