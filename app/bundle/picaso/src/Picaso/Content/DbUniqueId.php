<?php

namespace Picaso\Content;

/**
 * Class DbUniqueId
 *
 * @package Picaso\Content
 */
class DbUniqueId implements UniqueIdGenerator
{

    /**
     * @return int
     */
    public function nextId()
    {
        $db = \App::db();
        $conn = $db->getMaster();

        $table = $db->getName('core_uid_generator');

        $conn->exec('INSERT INTO ' . $table . ' VALUES ()');

        $nextId = $conn->lastId();

        if (empty($nextId)) {
            throw new \InvalidArgumentException("Could not generate next id");
        }

        return $nextId;
    }

    /**
     * @param int $value
     */
    public function setNextId($value)
    {
        $db = \App::db();
        $conn = $db->getMaster();

        $table = $db->getName('core_uid_generator');

        $conn->query('INSERT INTO ' . $table . ' (uid) VALUES (' . $value . ')');
    }
}