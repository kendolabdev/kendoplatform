<?php

namespace Kendo\Kernel;

/**
 * Class DbUniqueIdGenerate
 *
 * @package Kendo\Kernel
 */
class DbUniqueIdGenerator implements UniqueIdGeneratorInterface
{

    /**
     * @return int
     */
    public function nextId()
    {
        $db = app()->db();
        $conn = $db->getMaster();

        $table = $db->getName('platform_core_uid_generator');

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
        $db = app()->db();
        $conn = $db->getMaster();

        $table = $db->getName('core_uid_generator');

        $conn->query('INSERT INTO ' . $table . ' (uid) VALUES (' . $value . ')');
    }
}