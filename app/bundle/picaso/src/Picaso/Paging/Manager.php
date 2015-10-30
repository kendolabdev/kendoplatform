<?php

namespace Picaso\Paging;

use Picaso\Db\SqlSelect;

/**
 * Class Manager
 *
 * @package Picaso\Paging
 */
class Manager
{
    /**
     * @var array
     */
    private $renders = [
        'nextPrev' => '\Picaso\Paging\RenderNextPrev',
        'more'     => '\Picaso\Paging\RenderMore',
    ];

    /**
     * @param string          $name
     * @param array           $options
     * @param PagingInterface $paging
     *
     * @return RenderInterface
     */
    public function getRender($name, $options, PagingInterface $paging)
    {
        if (!empty($this->renders[ $name ])) {

            $class = $this->renders[ $name ];

            return new $class($paging, $options);
        }

        throw new \InvalidArgumentException("paging render [$name] does not supported");

    }

    /**
     * @param $data
     *
     * @return PagingInterface
     */
    public function factory($data)
    {
        if ($data instanceof SqlSelect) {
            return new PagingSqlSelect($data);
        } else if (is_array($data)) {
            return new PagingArray($data);
        }
    }

}