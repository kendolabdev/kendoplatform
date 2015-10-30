<?php

namespace Message\Service;

use Picaso\Application\EventHandler;

/**
 * Class EventHandlerService
 *
 * @package Message\Service
 */
class EventHandlerService extends EventHandler
{


    /**
     * @param $item
     *
     * @return bool
     */
    public function onMenuMainMessages($item)
    {
        if (!\App::auth()->logged())
            return false;

        $item['class'] = 'visible-xs ni-message';

        return $item;
    }
}