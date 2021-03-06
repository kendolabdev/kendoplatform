<?php

namespace Platform\User\Service;

use Kendo\Kernel\KernelService;
use Kendo\User\Manager;
use Platform\User\Model\User;
use Platform\User\Model\UserAuthPassword;
use Platform\User\Model\UserAuthRemote;

/**
 * Class Platform\UserService
 *
 * @package Platform\User\Service
 */
class UserService extends KernelService implements Manager
{

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminUserPaging($query, $page, $limit = 20)
    {

        $select = app()->table('platform_user')->select('u');

        if (!empty($query['role']) && !in_array($query['role'], ['', 'all'])) {
            $select->where('u.role_id=?', (string)$query['role']);
        }

        if (isset($query['active']) && !in_array($query['active'], ['', 'all'])) {
            $select->where('u.is_active=?', $query['active'] ? 1 : 0);
        }

        if (isset($query['verified']) && !in_array($query['verified'], ['', 'all'])) {
            $select->where('u.is_verified=?', $query['verified'] ? 1 : 0);
        }

        if (isset($query['approve']) && !in_array($query['approve'], ['', 'all'])) {
            $select->where('u.is_approved=?', $query['approve'] ? 1 : 0);
        }

        if (isset($query['gender']) && !in_array($query['gender'], ['', 'all'])) {
            $select->where('u.gender=?', (string)$query['gender']);
        }

        if (!empty($query['q'])) {
            $q = '%' . (string)$query['q'] . '%';
            $select->where('u.name like :q or u.email like :q', [':q' => $q]);
        }

        if (isset($query['photo']) && !in_array($query['photo'], ['', 'all'])) {
            $select->where('u.photo_file_id = ?', $query['photo'] ? 1 : 0);
        }

        if (!empty($query['created']) && !in_array($query['created'], ['', 'all'])) {
            $date = $query['created'];
            switch ($date) {
                case '1hour':
                    $date = date('Y-m-d H:00:00', time() - 3599);
                    break;
                case 'today':
                    $date = date('Y-m-d 00:00:00', time());
                    break;
                case '24hours':
                    $date = date('Y-m-d H:i:s', time() - 86400);
                    break;
                case '7days':
                    $date = date('Y-m-d', time() - 7 * 86400);
                    break;
                case '30days':
                    $date = date('Y-m-d', time() - 30 * 86400);
                    break;
                case 'this_month':
                    $date = date('Y-m-00', time());
                    break;
                case 'this_year':
                    $date = date('Y-01-00', time());
                    break;
            }
            $select->where('u.created_at > ?', $date);
        }


        $select->order('created_at', -1);

        return $select->paging($page, $limit);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadUserPaging($query = [], $page = 1, $limit = 12)
    {

        $viewer = app()->auth()->getViewer();

        if (!empty($query)) {

        }

        $select = app()->table('platform_user')
            ->select()
            ->where('is_active=?', 1)
            ->order('created_at', -1);

        if ($viewer instanceof User) {
            $select->where('user_id <> ?', $viewer->getId());
        }

        if (empty($query['sort']))
            $query['sort'] = 'created';

        switch ($query['sort']) {
            case 'rand':
                $select->order('rand()', null);
        }


        return $select->paging($page, $limit);
    }

    /**
     * Get approval & enabled members
     *
     * @return int
     */
    public function getActiveUserCount()
    {
        return app()->table('platform_user')
            ->select()
            ->where('is_approved=?', 1)
            ->where('is_published=?', 1)
            ->where('is_active=?', 1)
            ->count();
    }

    /**
     * @return \Platform\Relation\Service\RelationService
     */
    public function membership()
    {
        return app()->relation();
    }

    /**
     * @param string $identity
     *
     * @return \Platform\User\Model\User
     */
    public function findUserByIdentity($identity)
    {
        $identity = (string)$identity;

        return app()->table('platform_user')
            ->select()
            ->where('email=?', $identity)
            ->orWhere('profile_name=?', $identity)
            ->orWhere('user_id=?', $identity)
            ->one();
    }

    /**
     * @param $email
     *
     * @return \Platform\User\Model\User
     */
    public function findUserByEmail($email)
    {
        return app()->table('platform_user')
            ->select()
            ->where('email=?', $email)
            ->one();
    }

    /**
     * @param $profileName
     *
     * @return \Platform\User\Model\User
     */
    public function findUserByProfileName($profileName)
    {
        return app()->table('platform_user')
            ->select()
            ->where('profile_name=?', $profileName)
            ->one();
    }

    /**
     * @param \Platform\User\Model\User $user
     * @param string                    $remoteUID
     * @param string                    $remoteService
     *
     * @return \Platform\User\Model\UserAuthRemote
     */
    public function addRemoteUser(User $user, $remoteUID, $remoteService)
    {
        $remote = app()->table('platform_user_auth_remote')
            ->select()
            ->where('remote_uid=?', $remoteUID)
            ->where('remote_service=?', $remoteService)
            ->one();

        if (!$remote) {
            $remote = new UserAuthRemote([
                'remote_uid'     => $remoteUID,
                'remote_service' => $remoteService,
                'created_at'     => KENDO_DATE_TIME,
            ]);
        }

        $remote->setUserId($user->getId());

        $remote->save();

        return $remote;
    }


    /**
     * @param       $userId
     * @param array $enctypes
     *
     * @return array
     */
    public function findAllPassword($userId, $enctypes)
    {

        if (empty($enctypes)) {
            $enctypes = app()->auth()->getSupportHashTypes();
        }

        if (is_string($enctypes)) {
            $enctypes = [$enctypes];
        }


        return app()->table('platform_user_auth_password')
            ->select()
            ->where('user_id=?', (string)$userId)
            ->where('is_active=?', 1)
            ->where('enctype in (?)', $enctypes)
            ->toAssocs();
    }

    /**
     * @return int
     */
    public function getGuestRoleId()
    {
        return 6;
    }


    /**
     * @param  array $data
     *
     * @return \Platform\User\Model\User
     */
    public function addUser($data)
    {
        $data = array_merge($data, [
            'created_at'  => KENDO_DATE_TIME,
            'modified_at' => KENDO_DATE_TIME,
        ]);

        if (empty($data['profile_name'])) {
            $data['profile_name'] = uniqid();
        }

        $data ['role_id'] = $this->getDefaultRoleId();

        $user = new User($data);

        $user->save();

        if (!$user instanceof User)
            throw new \InvalidArgumentException("Could not create user");

        $password = null;

        if (!empty($data['password'])) {
            $password = (string)$data['password'];
        } else {
            $password = uniqid();
        }

        $this->setPassword($user->getId(), $password);


        if (!empty($data['remote_uid']) && !empty($data['remote_service'])) {
            $this->addRemoteUser($user, $data['remote_uid'], $data['remote_service']);
        }

        app()->emitter()
            ->emit('onCompleteCreatePoster', [
                'poster' => $user,
                'data'   => $data,
            ]);

        return $user;
    }

    /**
     * @param string|int $userId
     * @param string     $encrypt_type
     *
     * @return \Platform\User\Model\UserAuthPassword
     */
    public function findPassword($userId, $encrypt_type)
    {
        return app()->table('platform_user_auth_password')
            ->select()
            ->where('user_id=?', $userId)
            ->where('is_active=?', 1)
            ->where('enctype=?', $encrypt_type)
            ->one();
    }

    /**
     * @param string $userId
     * @param string $password
     * @param string $encrypt_type
     *
     * @return \Platform\User\Model\UserAuthPassword
     */
    public function setPassword($userId, $password, $encrypt_type = null)
    {
        if (null == $encrypt_type)
            $encrypt_type = 'default';

        $item = $this->findPassword($userId, $encrypt_type);


        if (empty($item)) {
            $item = new UserAuthPassword([
                'user_id'    => $userId,
                'enctype'    => $encrypt_type,
                'is_active'  => 1,
                'created_at' => KENDO_DATE_TIME
            ]);
        }

        $hashGenerator = app()->auth()->getHashGenerator($encrypt_type);

        $salt = $hashGenerator->getSalt();
        $hash = $hashGenerator->getHash($password, $salt);

        $item->setSalt($salt);
        $item->setHash($hash);
        $item->setActive(1);
        $item->setModifiedAt(KENDO_DATE_TIME);

        $item->save();
    }

    /**
     * @return int
     */
    public function getDefaultRoleId()
    {
        return 4;
    }
}