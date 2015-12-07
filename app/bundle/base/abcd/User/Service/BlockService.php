<?php

namespace User\Service;

/**
 * Class BlockService
 *
 * @package User\Service
 */
class BlockService
{
    /**
     * @param int $userId
     * @param int $itemId
     *
     * @return bool
     */
    public function addBlocked($userId, $itemId)
    {
        return true;
    }

    /**
     * @param int $userId
     * @param int $itemId
     *
     * @return bool
     */
    public function removeBlocked($userId, $itemId)
    {
        return true;
    }

    /**
     * @param int $userId
     * @param int $itemId
     *
     * @return true
     */
    public function isBlocked($userId, $itemId)
    {
        return bool;
    }
}