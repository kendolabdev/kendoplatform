<?php
namespace Picaso\Comparator;

/**
 * Class Manager
 *
 * @package Picaso\Comparator
 */
class Manager
{

    /**
     * @var array
     */
    protected $comparators = [];

    /**
     * @var array
     */
    protected $plugins = [
        'equal'   => '\Picaso\Comparator\CompareEqual',
        'contain' => '\Picaso\Comparator\CompareContain',
    ];

    /**
     * @return array
     */
    public function getComparators()
    {
        return $this->comparators;
    }

    /**
     * @param array $comparators
     */
    public function setComparators($comparators)
    {
        $this->comparators = $comparators;
    }

    /**
     * @param string $comparator
     * @param mixed  $actual
     * @param mixed  $params
     *
     * @return bool
     */
    public function test($comparator, $actual, $params)
    {
        return $this->getPlugin($comparator)->isValid($actual, $params);
    }

    /**
     * @param $comparator
     *
     * @return ComparatorInterface
     */
    public function getPlugin($comparator)
    {
        if (!isset($this->comparators[ $comparator ])) {
            if (!isset($this->plugins[ $comparator ])) {
                throw new \InvalidArgumentException("Mising comparator [$comparator]");
            }

            $class = $this->plugins[ $comparator ];
            $this->comparators[ $comparator ] = new $class;
        }

        return $this->comparators[ $comparator ];
    }

}