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
    private $decorators = [
        'nextPrev' => '\Picaso\Paging\NextPrevDecorator',
        'more'     => '\Picaso\Paging\LoadMoreDecorator',
    ];

    /**
     * @param string          $name
     * @param array           $options
     * @param PagingInterface $paging
     *
     * @return Decorator
     */
    public function getDecorator($name, $options, PagingInterface $paging)
    {
        if (!empty($this->decorators[ $name ])) {

            $class = $this->decorators[ $name ];

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