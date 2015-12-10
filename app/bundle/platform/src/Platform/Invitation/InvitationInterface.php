<?php

namespace Platform\Invitation;

use Platform\Invitation\Model\Invitation;

/**
 * Interface Platform\InvitationInterface
 *
 * @package Platform\Invitation
 */
interface InvitationInterface
{

    /**
     * @param \Platform\Invitation\Model\Invitation $invitation
     */
    public function __construct(Invitation $invitation);

    /**
     * Accept request
     */
    public function onAccept();

    /**
     * Deny request
     */
    public function onDeny();

    /**
     * @return string
     */
    public function getHeadline();

    /**
     * @param array $params
     *
     * @return string
     */
    public function toHref($params = []);

}