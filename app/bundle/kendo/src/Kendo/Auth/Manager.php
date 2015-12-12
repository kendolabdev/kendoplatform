<?php
namespace Kendo\Auth;


use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Platform\User\Model\User;

/**
 * Provide flexiable way to support login as
 * now user can logged in as any page, group, event, ... hey manage that implement Poster interface
 * Class Manager
 *
 *
 * @package Kendo\Auth
 */
class Manager
{

    /**
     * @var \Platform\User\Model\User
     */
    private $user;

    /**
     * @var \Kendo\Content\PosterInterface
     */
    private $viewer;

    /**
     * @var array
     */
    private $hashTypes = [
        'default' => '\Kendo\Auth\DefaultHashGenerator',
    ];

    /**
     * @var array
     */
    private $authTypes = [
        'default' => '\Platform\User\Auth\AuthPassword',
        'remote'  => '\Platform\User\Auth\AuthRemote',
    ];

    /**
     * @var array
     */
    private $storageTypes = [
        'default' => '\Platform\User\Auth\AuthStorage',
    ];

    /**
     * @return \Platform\User\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Platform\User\Model\User $user
     *
     * @throws AuthException
     */
    public function setUser($user = null)
    {

        if (null == $user && !$user instanceof User) {
            throw new AuthException("Could not set user of none user object");
        }
        $this->user = $user;

        // false back to user
        if (null == $this->viewer) {
            $this->viewer = $user;

        }

    }

    /**
     * @return \Kendo\Content\PosterInterface
     */
    public function getViewer()
    {

        return $this->viewer;
    }

    /**
     * @param \Kendo\Content\PosterInterface $viewer
     *
     * @throws AuthException
     */
    public function setViewer($viewer)
    {
        if (null != $viewer && !$viewer instanceof PosterInterface) {
            throw new AuthException("Could not set viewer from object that does not support Poster interface");

        }
        $this->viewer = $viewer;
    }

    /**
     * @return int
     */
    public function getUserRoleId()
    {
        return null != $this->user ? (int)$this->user->getRoleId() : KENDO_DEFAULT_ROLE_ID;
    }

    /**
     * @return int
     */
    public function getRoleId()
    {
        return null != $this->viewer ? (int)$this->viewer->getRoleId() : KENDO_DEFAULT_ROLE_ID;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return null != $this->viewer ? (int)$this->viewer->getId() : 0;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return null != $this->viewer ? $this->viewer->getType() : '';
    }

    /**
     * @return int|null|string
     */
    public function getUserId()
    {
        return null != $this->user ? $this->user->getId() : 0;
    }

    /**
     * @return bool
     */
    public function logged()
    {
        return null != $this->user;
    }

    /**
     * @param $adapter
     *
     * @return AuthInterface
     * @throws  \InvalidArgumentException
     */
    public function getAdapter($adapter)
    {
        if (null == $adapter) {
            $adapter = 'default';
        }

        if (empty($this->authTypes[ $adapter ])) {
            throw new \InvalidArgumentException("Adaptee [$adapter] does not support");
        }

        $class = $this->authTypes[ $adapter ];

        $auth = new $class;

        if (!$auth instanceof AuthInterface) {
            throw new AuthException("Adaptee must implement AuthInterface ");
        }

        return $auth;
    }

    /**
     * @param string $encrypt
     *
     * @return AuthHashInterface
     */
    public function getHashGenerator($encrypt = null)
    {
        if (null == $encrypt) {
            $encrypt = 'default';
        }

        if (empty($this->hashTypes[ $encrypt ])) {
            throw new \InvalidArgumentException("Unsupported hash type [$encrypt]");
        }

        $className = $this->hashTypes[ $encrypt ];

        if (!class_exists($className)) {
            throw new \InvalidArgumentException("Class [$className] does not found");
        }

        $hashGenerator = new $className;

        if (!$hashGenerator instanceof AuthHashInterface) {
            throw new AuthException("Invalid arguments");
        }

        return $hashGenerator;
    }

    /**
     * @return bool
     */
    public function isUser()
    {
        return $this->viewer instanceof User;
    }

    /**
     * @return array
     */
    public function getSupportHashTypes()
    {
        return array_keys($this->hashTypes);
    }

    /**
     * @param         $user
     * @param  bool   $remember
     * @param  string $adaptee
     */
    public function store($user, $remember = false, $adaptee = null)
    {
        $this->getStorage($adaptee)->store($user, $remember);
    }

    /**
     * @param        $poster
     * @param string $adaptee
     */
    public function saveViewer($poster, $adaptee = null)
    {
        $this->getStorage($adaptee)->saveViewer($poster);
    }

    /**
     * @param string $adapter
     * @param array  $params
     *
     * @return AuthResult
     */
    public function login($adapter, $params)
    {
        $auth = $this->getAdapter($adapter);

        $result = $auth->auth($params);

        return $result;
    }

    /**
     * @param $adapter
     *
     * @return AuthStorageInterface
     */
    public function getStorage($adapter)
    {
        if (null == $adapter) {
            $adapter = 'default';
        }

        if (empty($this->storageTypes[ $adapter ])) {
            throw new \InvalidArgumentException("Un-support Auth Storage Type [$adapter]");
        }

        $class = $this->storageTypes[ $adapter ];

        $obj = new $class;

        if (!$obj instanceof AuthStorageInterface) {
            throw new \InvalidArgumentException("Does not support Auth Storage Type");
        }

        return $obj;

    }

    /**
     * Forget current auth result
     */
    public function logout()
    {
        $this->forget(null);
    }

    /**
     * @param null $adapter
     */
    public function restore($adapter = null)
    {
        $this->getStorage($adapter)->restore();
    }

    /**
     * @param null $adapter
     */
    public function forget($adapter = null)
    {
        $this->getStorage($adapter)->forget();
    }

    /**
     * Is poster or owner
     *
     * @param ContentInterface|PosterInterface $item
     *
     * @return bool
     */
    public function isOwner($item)
    {
        if (!$this->logged())
            return false;

        return (bool)array_intersect(
            [$item->getId(), $item->getParentId(), $item->getParentUserId(),
             $item->getPosterId(), $item->getPosterId(), $item->getUserId()],
            [$this->getId(), $this->getUserId()]);
    }

    /**
     * @param ContentInterface|PosterInterface $item
     *
     * @return bool
     */
    public function isPoster($item)
    {
        if (!$this->logged())
            return false;

        return (bool)array_intersect([$this->getId(), $this->getUserId()],
            [$item->getId(), $item->getPosterId(), $item->getUserId()]);
    }

    /**
     * @param ContentInterface|PosterInterface $item
     *
     * @return bool
     */
    public function isParent($item)
    {
        if (!$this->logged())
            return false;

        return (bool)array_intersect([$this->getId(), $this->getUserId()],
            [$item->getId(), $item->getParentId(), $item->getParentUserId()]);
    }
}