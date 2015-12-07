<?php

namespace User\Controller\Ajax;

use Kendo\Controller\AjaxController;
use User\Model\User;

/**
 * Class FriendController
 *
 * @package User\Controller\Ajax
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
        $select = \App::table('user')
            ->select()
            ->limit(20, 0);

        $poster = \App::authService()->getViewer();

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

        $friend = \App::find('user', $friendId);

        $ctx = $this->request->getParam('ctx', 'btn');

        $viewer = \App::authService()->getViewer();

        if (!$friend instanceof User) {
            throw new \InvalidArgumentException("friendId is not user");
        }

        if (!$viewer instanceof User) {
            throw new \InvalidArgumentException("must logged in as member");
        }

        $friendService = $this->getFriendService();

        $friendService->{$method}($viewer, $friend);


        $this->response['html'] = \App::viewHelper()->btnUserMembership($friend, null, $ctx);
    }

    /**
     * @param string $method
     */
    private function doManagerAction($method)
    {
        $friendId = $this->request->getString('friendId');

        $ctx = $this->request->getParam('ctx', 'btn');

        $friend = \App::find('user', $friendId);

        $viewer = \App::authService()->getViewer();

        if (!$friend instanceof User) {
            throw new \InvalidArgumentException("friendId is not user");
        }

        if (!$viewer instanceof User) {
            throw new \InvalidArgumentException("must logged in as member");
        }

        $friendService = $this->getFriendService();

        $friendService->{$method}($friend, $viewer);

        $this->response['html'] = \App::viewHelper()->btnUserMembership($friend, null, $ctx);
    }

    /**
     * @return \Relation\Service\RelationService
     */
    public function getFriendService()
    {
        return \App::relationService();
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
        list($id, $eid) = $this->request->get('id', 'eid');

        $item = \App::find('user', $id);

        $viewer = \App::authService()->getViewer();

        $membership = \App::userService()->membership()->getMembershipStatus($viewer, $item);

        $this->response = [
            'html' => $this->partial('base/user/partial/membership-options', [
                'item'       => $item,
                'eid'        => $eid,
                'membership' => $membership,
                'friend'     => $item,
            ])];
    }
}