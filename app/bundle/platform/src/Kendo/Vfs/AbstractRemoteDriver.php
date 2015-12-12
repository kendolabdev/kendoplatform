<?php
namespace Kendo\Vfs;

/**
 * Class AbstractRemoteAdapter
 *
 * @package Kendo\Vfs
 */
abstract class AbstractRemoteDriver extends AbstractDriver
{
    /**
     * @var int
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var int
     */
    protected $timeout = 90;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \resource
     */
    protected $_handle;

    /**
     *
     */
    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return array_merge(parent::__sleep(), [
            '_host', '_port', '_timeout', '_useSsl', '_username', '_password'
        ]);
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        if (null === $this->resource) {
            $this->connect();
            $this->login();
        }

        return $this->resource;
    }

    /**
     * @param int $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param $port
     *
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = (int)$timeout;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return null
     */
    abstract public function connect();

    /**
     * @return null
     */
    abstract public function disconnect();

    /**
     * @return null
     */
    abstract public function login();
}