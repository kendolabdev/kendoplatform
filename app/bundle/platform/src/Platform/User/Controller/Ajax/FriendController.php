<?php

namespace Platform\User\Controller\Ajax;

use Kendo\Controller\AjaxController;
use Platform\User\Model\User;

/**
 * Class FriendController
 *
 * @package Platform\User\Controller\Ajax
 */
class FriendController extends AjaxController
{

    /**
     * Suggest friends
     *
     * @return array [{id: string, name: string, type: string, img: string, note: string }]
     */
    public function actionSuggest()
    {
        $select = app()->table('platform_user')
            ->select()
            ->limit(20, 0);

        $poster = app()->auth()->getViewer();

        if ($poster != null) {
            $select->where('user_id<>?', $poster->getId());
        }

        $users = $select->all();

        foreach ($users as $user) {

            if (!$user instanceof User) continue;
            $this->response[] = [
                'id'   => $user->getId(),
                'type' => $user->getType(),
                'name' => $user->getTitle(),
                'img'  => $user->getPhoto('xs'),
            ];
        }
    }

    /**
     * @param string $method
     */
    private function doPosterAction($method)
    {
        $friendId = $this->request->getString('friendId');

        $friend = app()->find('user', $friendId);

        $ctx = $this->request->getParam('ctx', 'btn');

        $viewer = app()->auth()->getViewer();

        if (!$friend instanceof User) {
            throw new \InvalidArgumentException("friendId is not user");
        }

        if (!$viewer instanceof User) {
            throw new \InvalidArgumentException("must logged in as member");
        }

        $friendService = $this->getFriendService();

        $friendService->{$method}($viewer, $friend);


        $this->response['html'] = app()->viewHelper()->btnUserMembership($friend, null, $ctx);
    }

    /**
     * @param string $method
     */
    private function doManagerAction($method)
    {
        $friendId = $this->request->getString('friendId');

        $ctx = $this->request->getParam('ctx', 'btn');

        $friend = app()->find('user', $friendId);

        $viewer = app()->auth()->getViewer();

        if (!$friend instanceof User) {
            throw new \InvalidArgumentException("friendId is not user");
        }

        if (!$viewer instanceof User) {
            throw new \InvalidArgumentException("must logged in as member");
        }

        $friendService = $this->getFriendService();

        $friendService->{$method}($friend, $viewer);

        $this->response['html'] = app()->viewHelper()->btnUserMembership($friend, null, $ctx);
    }

    /**
     * @return \Platform\Relation\Service\RelationService
     */
    public function getFriendService()
    {
        return app()->relation();
    }

    /**
     * Send friend request
     */
    public function actionRequest()
    {
        $this->doPosterAction('sendMembershipRequest');

    }

    /**
     * Cancel friend request
     */
    public function actionCancel()
    {
        $this->doPosterAction('cancelMembershipRequest');
    }

    /**
     * Cancel friend request
     */
    public function actionAccept()
    {
        $this->doManagerAction('acceptMembershipRequest');
    }

    /**
     * Cancel friend request
     */
    public function actionIgnore()
    {
        $this->doManagerAction('ignoreMembershipRequest');
    }

    /**
     * Cancel friend request
     */
    public function actionRemove()
    {
        $this->doManagerAction('removeMembership');
    }

    /**
     * Option membership
     */
    public function actionMembershipOptions()
    {
        list($id, $eid) = $this->request->getList('id', 'eid');

        $item = app()->find('user', $id);

        $viewer = app()->auth()->getViewer();

        $membership = app()->user()->membership()->getMembershipStatus($viewer, $item);

        $this->response = [
            'html' => $this->partial('platform/user/partial/membership-options', [
                'item'       => $item,
                'eid'        => $eid,
                'membership' => $membership,
                'friend'     => $item,
            ])];
    }
}