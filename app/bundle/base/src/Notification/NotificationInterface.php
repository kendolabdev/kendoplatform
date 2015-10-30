<?php

namespace Notification;

use Notification\Model\Notification;

/**
 * Interface NotificationInterface
 *
 * @package Notification
 */
interface NotificationInterface
{

    /**
     * @param Notification $notification
     */
    public function __construct(Notification $notification);

    /**
     * @return string
     */
    public function getHeadline();

    /**
     * @param array $context
     *
     * @return string
     */
    public function toHtml($context = []);

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = []);
}