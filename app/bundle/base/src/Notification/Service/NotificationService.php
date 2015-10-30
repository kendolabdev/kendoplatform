<?php

namespace Notification\Service;

use Feed\Model\Feed;
use Notification\Model\Notification;
use Notification\Model\NotificationSubscribe;
use Picaso\Acl\AuthorizationRestrictException;
use Picaso\Content\Atom;
use Picaso\Content\Content;
use Picaso\Content\Poster;

/**
 * Class NotificationService
 *
 * @package Notification\Service
 */
class NotificationService
{

    /**
     * @return array
     */
    public function getAllType()
    {
        return \App::table('notification.notification_type')
            ->select()
            ->where('user_edit=?', 1)
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
            ->all();
    }

    /**
     * @param $id
     *
     * @return \Notification\Model\NotificationType
     */
    public function findNotificationTypeById($id)
    {
        return \App::table('notification.notification_type')
            ->findById($id);
    }


    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadAdminNotificationTypePaging($query = [], $page = 1, $limit = 100)
    {
        $select = \App::table('notification.notification_type')
            ->select()
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames());

        if (!empty($query)) ; // skip this params

        return $select->paging($page, $limit);
    }

    /**
     * @return array
     */
    public function getListType()
    {
        return \App::table('notification.notification_type')
            ->select()
            ->where('user_edit=?', 1)
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
            ->all();
    }

    /**
     * @param string $group
     *
     * @return array
     */
    public function getListTypeByGroup($group)
    {
        return \App::table('notification.notification_type')
            ->select()
            ->where('user_edit=?', 1)
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
            ->where('notification_group=?', $group)
            ->all();

    }

    /**
     * @return array
     */
    public function getListTypeGroup()
    {
        return \App::cache()
            ->get([], 0, function () {
                return $this->_getListTypeGroup();
            });
    }

    /**
     * @return array
     */
    public function _getListTypeGroup()
    {
        return \App::table('notification.notification_type')
            ->select()
            ->where('user_edit=?', 1)
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
            ->order('n1 ', 1)
            ->columns('distinct(notification_group) as n1')
            ->fields('n1');

    }

    /**
     * @param Poster  $poster
     * @param Content $about
     *
     * @return \Notification\Model\NotificationSubscribe
     */
    public function findSubscribe(Poster $poster, $about)
    {
        return \App::table('notification.notification_subscribe')
            ->select()
            ->where('about_id=?', $about->getId())
            ->where('poster_id=?', $poster->getId())
            ->one();
    }

    /**
     * @param Poster  $poster
     * @param Content $about
     *
     * @return bool
     */
    public function subscribe(Poster $poster, Content $about)
    {
        $subscribe = $this->findSubscribe($poster, $about);

        if (null == $subscribe) {
            $subscribe = new NotificationSubscribe([
                'poster_id'   => $poster->getId(),
                'about_id'    => $about->getId(),
                'poster_type' => $poster->getType(),
                'about_type'  => $about->getType(),
                'created_at'  => PICASO_DATE_TIME,
            ]);

            $subscribe->save();

            return true;
        }

        return false;
    }

    /**
     * @param Poster  $poster
     * @param Content $about
     *
     * @return bool
     */
    public function unsubscribe(Poster $poster, $about)
    {

        $subscribe = $this->findSubscribe($poster, $about);

        if (null != $subscribe) {
            $subscribe->delete();

            return true;
        }

        return false;
    }

    /**
     * @param Content $about
     */
    public function removeAllByAbout($about)
    {
        \App::table('notification')
            ->delete()
            ->where('about_id=?', $about->getId())
            ->execute();

        \App::table('notification.subscribe')
            ->delete()
            ->where('about_id=?', $about->getId())
            ->execute();
    }

    /**
     * @param Poster $poster
     */
    public function removeAllByPoster($poster)
    {
        \App::table('notification.notification_subscribe')
            ->delete()
            ->where('poster_id=?', $poster->getId())
            ->execute();

        \App::table('notification')
            ->delete()
            ->where('poster_id=?', $poster->getId())
            ->orWhere('user_id=?', $poster->getId())
            ->orWhere('parent_id=?', $poster->getId())
            ->orWhere('parent_user_id=?', $poster->getId())
            ->execute();
    }

    /**
     * posterId subscribe object id ?
     *
     * @param Poster $poster
     * @param        $about
     *
     * @return bool
     */
    public function isSubscribed($poster, $about)
    {
        if ($about instanceof Feed)
            $about = $about->getAbout();

        return null != $this->findSubscribe($poster, $about);
    }

    /**
     * @param Poster  $poster
     * @param Content $about
     */
    public function toggleSubscribe(Poster $poster, $about)
    {
        $subscribe = $this->findSubscribe($poster, $about);

        if (null != $subscribe) {
            $subscribe->delete();
        } else {
            $subscribe = new NotificationSubscribe([
                'poster_id'   => $poster->getId(),
                'about_id'    => $about->getId(),
                'poster_type' => $poster->getType(),
                'about_type'  => $about->getType(),
                'created_at'  => PICASO_DATE_TIME,
            ]);
            $subscribe->save();
        }
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadNotificationPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('notification')->select();

        $isValid = true;

        if (!empty($query['parentId'])) {
            $select->where('parent_id=?', $query['parentId']);
            $isValid = true;
        }

        if (!empty($query['posterId'])) {
            $select->where('poster_id=?', $query['posterId']);
            $isValid = true;
        }

        if (!$isValid)
            $select->where('parent_id=?', (string)\App::auth()->getId());


        return $select->paging($page, $limit);
    }


    /**
     * @param Poster $parent
     *
     * @return int
     */
    public function getUnreadNotificationCount(Poster $parent = null)
    {
        if (null == $parent)
            $parent = \App::auth()->getViewer();


        if (!$parent instanceof Poster)
            return 0;

        return \App::table('notification')
            ->select()
            ->where('parent_id=?', (string)$parent->getId())
            ->where('`read`=?', '0')
            ->count();
    }

    /**
     * @param Poster $parent
     *
     * @return int
     */
    public function getUnmitigatedNotificationCount(Poster $parent = null)
    {
        if (null == $parent)
            $parent = \App::auth()->getViewer();


        if (!$parent instanceof Poster)
            return 0;

        return \App::table('notification')
            ->select()
            ->where('parent_id=?', (string)$parent->getId())
            ->where('`mitigated`=?', '0')
            ->count();
    }

    /**
     * @param \Picaso\Content\Poster|null $parent
     */
    public function clearMitigatedNotificationState(Poster $parent = null)
    {
        if (null == $parent)
            $parent = \App::auth()->getViewer();


        if (!$parent instanceof Poster)
            throw new AuthorizationRestrictException();


        \App::table('notification')
            ->update(['mitigated' => 1])
            ->where('parent_id=?', $parent->getId())
            ->execute();

    }

    /**
     * Send new notification to receiver(parent) from poster(sender)
     *
     * @param string         $type
     * @param Poster         $poster
     * @param Poster         $parent
     * @param Content|Poster $about
     * @param                $params
     *
     * @return Notification
     */
    public function addNotification($type, Poster $poster, Poster $parent, $about = null, $params = [])
    {

        if (!$about)
            $about = $poster;

        $data = [
            'type_id'        => $type,
            'poster_id'      => $poster->getId(),
            'user_id'        => $poster->getUserId(),
            'parent_id'      => $parent->getId(),
            'parent_user_id' => $parent->getUserId(),
            'poster_type'    => $poster->getType(),
            'parent_type'    => $parent->getType(),
            'about_type'     => $about->getType(),
            'about_id'       => $about->getId(),
            'params'         => json_encode($params),
            'created_at'     => PICASO_DATE_TIME,
        ];

        if (null != $about) {
            $data = array_merge($data, [
                'about_id'   => $about->getId(),
                'about_type' => $about->getType(),
            ]);
        }
        $item = new Notification($data);

        $item->save();

        return $item;
    }

    /**
     * Delete notification by type, poster_id and parent_id
     *
     * @param string $type
     * @param Poster $poster
     * @param Poster $parent
     *
     * @return bool
     */
    public function removeNotification($type, Poster $poster, Poster $parent)
    {
        \App::table('notification')
            ->delete()
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id=?', $parent->getId())
            ->where('type_id=?', $type)
            ->execute();
    }

    /**
     * @param Poster $parent
     *
     * @return string
     */
    public function getAcceptMembershipType($parent)
    {
        return sprintf('accept_membership_%s', $parent->getModuleName());
    }

    /**
     * @param Poster $parent
     * @param Poster $poster
     *
     * @return Notification
     */
    public function addAcceptMembershipNotification($parent, $poster)
    {
        return $this->addNotification($this->getAcceptMembershipType($parent), $poster, $parent);
    }

    /**
     * @param Poster $poster
     * @param Poster $parent
     */
    public function removeMembershipNotification(Poster $poster, Poster $parent)
    {
        $this->removeNotification($this->getAcceptMembershipType($parent), $poster, $parent);
    }

    /**
     * @param  Content $about
     * @param  int     $limit
     * @param  int     $offset
     *
     * @return array
     */
    public function getListSubscriber($about, $limit = 100, $offset = 0)
    {
        return \App::table('notification.notification_subscribe')
            ->select()
            ->where('about_id=?', $about->getId())
            ->limit($limit, $offset)
            ->order('created_at', 1)
            ->all();
    }

    /**
     * Send notify to members subscribed to about since item is created.
     * + How to store and broadcast a message to 1M members. ?
     * + A better way we design a schema like group chat?
     * + Push notification only ?
     * + How many notification we should send out each time?
     *
     * @param string $type
     * @param Poster $poster
     * @param mixed  $about
     * @param array  $params
     *
     */
    public function notify($type, $poster, $about, $params = [])
    {
        foreach ($this->getListSubscriber($about, 100, 0) as $subscribe) {

            if (!$subscribe instanceof NotificationSubscribe) continue;

            $receiver = $subscribe->getPoster();

            if (!$receiver instanceof Poster) continue;

            // do not notify to poster
            if ($poster->getId() == $receiver->getId()) continue;

            $this->addNotification($type, $poster, $receiver, $about, $params);

        }
    }

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListTypeByModuleName($moduleList)
    {
        return \App::table('notification.notification_type')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }
}