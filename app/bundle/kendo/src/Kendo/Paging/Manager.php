<?php

namespace Kendo\Paging;

use Kendo\Db\SqlSelect;

/**
 * Class Manager
 *
 * @package Kendo\Paging
 */
class Manager
{
    /**
     * @var array
     */
    private $decorators = [
        'nextPrev' => '\Kendo\Paging\NextPrevDecorator',
        'more'     => '\Kendo\Paging\LoadMoreDecorator',
    ];

    /**
     * @return array
     */
    public function getDecorators()
    {
        return $this->decorators;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param array $decorators
     */
    public function setDecorators($decorators)
    {
        $this->decorators = $decorators;
    }

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