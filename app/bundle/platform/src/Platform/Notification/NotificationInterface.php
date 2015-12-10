<?php

namespace Platform\Notification;

use Platform\Notification\Model\Notification;

/**
 * Interface Platform\NotificationInterface
 *
 * @package Platform\Notification
 */
interface NotificationInterface
{

    /**
     * @param \Platform\Notification\Model\Notification $notification
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