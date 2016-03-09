<?php

namespace Platform\Message\ViewHelper;

/**
 * Class ButtonBeeberMessage
 *
 * @package Message\ViewHelper
 */
class ButtonBearMessage
{

    /**
     * @return string
     */
    function __invoke()
    {
        if (!app()->auth()->logged()) return '';

        $number = app()->messageService()->getUnreadConversationCount();

        return app()->viewHelper()->partial('platform/message/button/bear-message', [
            'number' => $number,
        ]);
    }

}