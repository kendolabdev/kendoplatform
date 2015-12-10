<?php

namespace Base\Group\Invitation;

use Platform\Invitation\InvitationInterface;
use Platform\Invitation\Model\Invitation;


/**
 * Class RequestMembership
 *
 * @package Group\Alert
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

        return \App::text('group.$poster_request_join_groups', ['$poster' => $poster]);
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
}