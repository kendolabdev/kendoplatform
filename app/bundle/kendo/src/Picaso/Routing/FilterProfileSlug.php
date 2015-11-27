<?php

namespace Picaso\Routing;

use Picaso\Content\Poster;

/**
 * Class FilterProfileSlug
 *
 * @package Picaso\Routing
 */
class FilterProfileSlug implements FilterInterface
{

    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $token = 'name';

    /**
     * @var string
     */
    private $wheres;

    /**
     * @var bool
     */
    private $chain = true;

    /**
     * @var array
     */
    private $extra = [];

    /**
     * @param array $params
     *
     */
    public function __construct($params)
    {
        if (empty($params['table']) or empty($params['wheres']))
            throw new \InvalidArgumentException('Missing parameters "wheres, table"');

        $this->setTable($params['table']);

        $this->setWheres($params['wheres']);

        if (!empty($params['chain']))
            $this->setChain($params['chain']);


        if (!empty($params['token']))
            $this->setToken($params['token']);


        if (!empty($params['extra']))
            $this->setExtra($params['extra']);

    }

    /**
     * @param  array $params
     *
     * @return bool|array
     */
    public function filter($params)
    {
        if (defined('PICASO_INSTALLER'))
            return false;

        $token = $this->getToken();

        if (empty($params[ $token ])) {
            return false;
        }

        $table = \App::table($this->getTable());

        if (!$table)
            return false;

        $profile = $table
            ->select()
            ->where($this->getWheres(), (string)$params[ $token ])
            ->one();

        if (!$profile instanceof Poster)
            return false;

        \App::registryService()->set('profile', $profile);

        return array_merge($this->extra, [
            'profileId'   => $profile->getId(),
            'profileType' => $profile->getType(),
        ]);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = (string)$token;

    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = (string)$table;
    }

    /**
     * @return string
     */
    public function getWheres()
    {
        return $this->wheres;
    }

    /**
     * @param string $wheres
     */
    public function setWheres($wheres)
    {
        $this->wheres = (string)$wheres;
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
        $this->chain = (bool)$chain;
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
     * @return bool
     */
    public function stopOnFail()
    {
        return true;
    }
}