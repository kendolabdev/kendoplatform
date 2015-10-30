<?php

namespace Invitation;

use Invitation\Model\Invitation;

/**
 * Interface InvitationInterface
 *
 * @package Invitation
 */
interface InvitationInterface
{

    /**
     * @param Invitation $invitation
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