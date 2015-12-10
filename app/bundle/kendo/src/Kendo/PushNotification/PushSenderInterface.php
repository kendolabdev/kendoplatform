<?php

namespace Kendo\PushNotification;

/**
 * Interface PushSenderInterface
 *
 * @package Kendo\PushNotification
 */
interface PushSenderInterface
{

    /**
     * @param array $params
     */
    public function __construct($params);

    /**
     * @param PushMessage $message
     * @param array       $idList
     *
     * @return bool
     */
    public function send(PushMessage $message, $idList = []);
}

