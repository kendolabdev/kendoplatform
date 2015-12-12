<?php

namespace Platform\User\Invitation;

use Platform\Invitation\InvitationInterface;
use Platform\Invitation\Model\Invitation;


/**
 * Class RequestMembership
 *
 * @package Platform\User\Alert
 */
class RequestMembership implements InvitationInterface
{
    /**
     * @var Invitation
     */
    private $invitation;

    /**
     * @param Invitation $invitation
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Accept request
     */
    public function onAccept()
    {
        // TODO: Implement onAccept() method.
    }

    /**
     * Deny request
     */
    public function onDeny()
    {
        // TODO: Implement onDeny() method.
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        $poster = '<b>' . $this->invitation->getPoster()->getTitle() . '</b>';

        return \App::text('user.$poster_request_to_be_your_friends', ['$poster' => $poster]);
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = [])
    {
        return $this->invitation->getPoster()->toHref($params);
    }


    /**
     * @param array $context
     *
     * @return string
     */
    public function toHtml($context = [])
    {
        $attrs = [
            'id'   => $this->invitation->getId(),
            'type' => $this->invitation->getType(),
        ];

        return \App::viewHelper()->partial('platform/user/invitation/request-membership', [
            'headline' => $this->getHeadline(),
            'poster'   => $this->invitation->getPoster(),
            'parent'   => $this->invitation->getParent(),
            'request'  => $this->invitation,
            'attrs'    => $attrs,
        ]);
    }
}