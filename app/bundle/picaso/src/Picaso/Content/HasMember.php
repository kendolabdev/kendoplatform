<?php
namespace Picaso\Content;

/**
 * Interface HasMember
 *
 * @package Core\Content
 */
interface HasMember
{

    /**
     * @return int
     */
    public function getMemberCount();

    /**
     * @param $column
     * @param $value
     */
    public function modify($column, $value);
}