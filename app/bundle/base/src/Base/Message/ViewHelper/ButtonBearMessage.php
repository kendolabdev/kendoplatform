<?php

namespace Base\Message\ViewHelper;

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

        return \App::viewHelper()->partial('base/message/button/bear-message', [
            'number' => $number,
        ]);
    }

}