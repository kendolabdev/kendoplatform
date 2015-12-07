<?php

namespace Kendo\Content;

/**
 * Class DbUniqueId
 *
 * @package Kendo\Content
 */
class DbUniqueId implements UniqueIdInterface
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