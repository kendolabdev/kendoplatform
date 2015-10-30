<?php

namespace Message\ViewHelper;

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
        if (!\App::auth()->logged()) return '';

        $number = \App::message()->getUnreadConversationCount();

        return \App::viewHelper()->partial('base/message/button/bear-message', [
            'number' => $number,
        ]);
    }

}