<?php
namespace Platform\User\Notification;

use Platform\Notification\Model\Notification;
use Platform\Notification\NotificationInterface;

/**
 * Class AcceptMembership
 *
 * @package Platform\User\Notification
 */
class AcceptMembership implements NotificationInterface
{
    /**
     * @var Notification
     */
    private $notification;

    /**
     * @param Notification $notification
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        $poster = '<b>' . $this->notification->getPoster()->getTitle() . '</b>';

        return \App::text('user.$poster_become_your_friends', ['$poster' => $poster]);
    }

    /**
     * @param array $context
     *
     * @return string
     */
    public function toHtml($context = [])
    {
        return \App::viewHelper()->partial('base/user/notification/accept-membership', [
            'headline' => $this->getHeadline(),
            'item'     => $this->notification,
            'href'     => $this->toHref(),
            'poster'   => $this->notification->getPoster(),
        ]);
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        return $this->notification->getPoster()->toHref($params);
    }
}