<?php

namespace Platform\Notification\Service;

use Base\Feed\Model\Feed;
use Platform\Notification\Model\Notification;
use Platform\Notification\Model\NotificationSubscribe;
use Kendo\Acl\AuthorizationRestrictException;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;

/**
 * Class Platform\NotificationService
 *
 * @package Platform\Notification\Service
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
     * @return \Platform\Notification\Model\NotificationType
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
     * @return \Kendo\Paging\PagingInterface
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
        return \App::cacheService()
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
     * @param PosterInterface  $poster
     * @param ContentInterface $about
     *
     * @return \Platform\Notification\Model\NotificationSubscribe
     */
    public function findSubscribe(PosterInterface $poster, $about)
    {
        return \App::table('notification.notification_subscribe')
            ->select()
            ->where('about_id=?', $about->getId())
            ->where('poster_id=?', $poster->getId())
            ->one();
    }

    /**
     * @param PosterInterface  $poster
     * @param ContentInterface $about
     *
     * @return bool
     */
    public function subscribe(PosterInterface $poster, ContentInterface $about)
    {
        $subscribe = $this->findSubscribe($poster, $about);

        if (null == $subscribe) {
            $subscribe = new NotificationSubscribe([
                'poster_id'   => $poster->getId(),
                'about_id'    => $about->getId(),
                'poster_type' => $poster->getType(),
                'about_type'  => $about->getType(),
                'created_at'  => KENDO_DATE_TIME,
            ]);

            $subscribe->save();

            return true;
        }

        return false;
    }

    /**
     * @param PosterInterface  $poster
     * @param ContentInterface $about
     *
     * @return bool
     */
    public function unsubscribe(PosterInterface $poster, $about)
    {

        $subscribe = $this->findSubscribe($poster, $about);

        if (null != $subscribe) {
            $subscribe->delete();

            return true;
        }

        return false;
    }

    /**
     * @param ContentInterface $about
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
     * @param PosterInterface $poster
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
     * @param PosterInterface $poster
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
     * @param PosterInterface  $poster
     * @param ContentInterface $about
     */
    public function toggleSubscribe(PosterInterface $poster, $about)
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
                'created_at'  => KENDO_DATE_TIME,
            ]);
            $subscribe->save();
        }
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
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
            $select->where('parent_id=?', (string)\App::authService()->getId());


        return $select->paging($page, $limit);
    }


    /**
     * @param PosterInterface $parent
     *
     * @return int
     */
    public function getUnreadNotificationCount(PosterInterface $parent = null)
    {
        if (null == $parent)
            $parent = \App::authService()->getViewer();


        if (!$parent instanceof PosterInterface)
            return 0;

        return \App::table('notification')
            ->select()
            ->where('parent_id=?', (string)$parent->getId())
            ->where('`read`=?', '0')
            ->count();
    }

    /**
     * @param PosterInterface $parent
     *
     * @return int
     */
    public function getUnmitigatedNotificationCount(PosterInterface $parent = null)
    {
        if (null == $parent)
            $parent = \App::authService()->getViewer();


        if (!$parent instanceof PosterInterface)
            return 0;

        return \App::table('notification')
            ->select()
            ->where('parent_id=?', (string)$parent->getId())
            ->where('`mitigated`=?', '0')
            ->count();
    }

    /**
     * @param \Kendo\Content\PosterInterface|null $parent
     */
    public function clearMitigatedNotificationState(PosterInterface $parent = null)
    {
        if (null == $parent)
            $parent = \App::authService()->getViewer();


        if (!$parent instanceof PosterInterface)
            throw new AuthorizationRestrictException();


        \App::table('notification')
            ->update(['mitigated' => 1])
            ->where('parent_id=?', $parent->getId())
            ->execute();

    }

    /**
     * Send new notification to receiver(parent) from poster(sender)
     *
     * @param string                           $type
     * @param PosterInterface                  $poster
     * @param PosterInterface                  $parent
     * @param ContentInterface|PosterInterface $about
     * @param                $params
     *
     * @return Platform\Notification
     */
    public function addNotification($type, PosterInterface $poster, PosterInterface $parent, $about = null, $params = [])
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
            'created_at'     => KENDO_DATE_TIME,
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
     * @param string          $type
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return bool
     */
    public function removeNotification($type, PosterInterface $poster, PosterInterface $parent)
    {
        \App::table('notification')
            ->delete()
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id=?', $parent->getId())
            ->where('type_id=?', $type)
            ->execute();
    }

    /**
     * @param PosterInterface $parent
     *
     * @return string
     */
    public function getAcceptMembershipType($parent)
    {
        return sprintf('accept_membership_%s', $parent->getModuleName());
    }

    /**
     * @param PosterInterface $parent
     * @param PosterInterface $poster
     *
     * @return Platform\Notification
     */
    public function addAcceptMembershipNotification($parent, $poster)
    {
        return $this->addNotification($this->getAcceptMembershipType($parent), $poster, $parent);
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     */
    public function removeMembershipNotification(PosterInterface $poster, PosterInterface $parent)
    {
        $this->removeNotification($this->getAcceptMembershipType($parent), $poster, $parent);
    }

    /**
     * @param  ContentInterface $about
     * @param  int              $limit
     * @param  int              $offset
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
     * @param string          $type
     * @param PosterInterface $poster
     * @param mixed           $about
     * @param array           $params
     *
     */
    public function notify($type, $poster, $about, $params = [])
    {
        foreach ($this->getListSubscriber($about, 100, 0) as $subscribe) {

            if (!$subscribe instanceof NotificationSubscribe) continue;

            $receiver = $subscribe->getPoster();

            if (!$receiver instanceof PosterInterface) continue;

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