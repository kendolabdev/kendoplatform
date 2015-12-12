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
        if (!\App::authService()->logged()) return '';

        $number = \App::messageService()->getUnreadConversationCount();

        return \App::viewHelper()->partial('platform/message/button/bear-message', [
            'number' => $number,
        ]);
    }

}