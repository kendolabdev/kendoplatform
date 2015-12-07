<?php

namespace Kendo\Routing;

/**
 * Class FilterCompare
 *
 * @package Kendo\Routing
 */
class FilterCompare implements FilterInterface
{

    /**
     * @var array
     */
    private $wheres;

    /**
     * @var array
     */
    private $extra = [];

    /**
     * @var bool
     */
    private $chain = true;

    /**
     * @param array $params
     */
    public function __construct($params)
    {
        if (empty($params['wheres']))
            throw new \InvalidArgumentException('Parameters "wheres" is required');

        if (!empty($params['extra']))
            $this->setExtra($params['extra']);


        $this->setWheres($params['wheres']);
    }


    /**
     * @param array $params
     *
     * @return bool|array
     */
    public function filter($params)
    {
        foreach ($this->wheres as $compare) {
            $token = $compare['token'];


            if (!isset($params[ $token ]))
                return false;


            if (isset($compare['value'])) {
                if ($params[ $token ] != $compare['value'])
                    return false;

            } else if (isset($compare['values'])) {
                if (!in_array($params['token'], $compare['values']))
                    return false;

            }
        }

        return $this->getExtra();
    }

    /**
     * @return array
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param array $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    /**
     * @return array
     */
    public function getWheres()
    {
        return $this->wheres;
    }

    /**
     * @param array $wheres
     */
    public function setWheres($wheres)
    {
        if (isset($wheres['token'])) {
            $this->wheres[] = $wheres;
        } else {
            $this->wheres = $wheres;
        }
    }

    /**
     * @return boolean
     */
    public function isChain()
    {
        return $this->chain;
    }

    /**
     * @param boolean $chain
     */
    public function setChain($chain)
    {
        $this->chain = $chain;
    }

    /**
     * @return bool
     */
    public function stopOnFail()
    {
        return false;
    }
}