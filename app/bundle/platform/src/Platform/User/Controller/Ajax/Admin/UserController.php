<?php
namespace Platform\User\Controller\Ajax\Admin;


use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;
use Platform\User\Model\User;

class UserController extends AjaxController
{

    /**
     * active member
     */
    public function actionEnable()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $user = \App::find($type, $id);

        if (!$user instanceof User)
            throw new \InvalidArgumentException("Not member");

        $user->setActive(1);
        $user->save();

        $this->response = [
            'success' => 'Member is active'
        ];
    }

    /**
     * disabled member
     */
    public function actionDisable()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $user = \App::find($type, $id);

        if (!$user instanceof User)
            throw new \InvalidArgumentException("Not member");

        $user->setActive(0);
        $user->save();

        $this->response = [
            'success' => 'Member is un-active'
        ];
    }

    /**
     *
     */
    public function actionVerify()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $user = \App::find($type, $id);

        if (!$user instanceof User)
            throw new \InvalidArgumentException("Not member");

        $user->setVerified(1);
        $user->save();

        $this->response = [
            'success' => 'Member is verified'
        ];
    }

    /**
     *
     */
    public function actionApprove()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $user = \App::find($type, $id);

        if (!$user instanceof User)
            throw new \InvalidArgumentException("Not member");

        $user->setApproved(1);
        $user->save();

        $this->response = [
            'success' => 'Member is approved'
        ];
    }


    /**
     *
     */
    public function actionOptions()
    {
        list($type, $id, $eid) = $this->request->get('type', 'id', 'eid');

        $user = \App::find($type, $id);

        if (!$user instanceof User)
            throw new \InvalidArgumentException("Not member");

        $data = [
            'item'  => $user,
            'eid'   => $eid,
            'token' => _escape($user->toTokenArray())];

        $this->response = [
            'html' => $this->partial('platform/user/partial/admin/user/options', $data),
        ];
    }

    /**
     *
     */
    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);

        $query = $this->request->getArray('query');

        $paging = \App::userService()->loadAdminUserPaging($query, $page);

        $lp = new BlockParams($this->request->getParam('lp'));

        $html = $this->partial($lp->itemScript(), [
            'paging' => $paging,
            'lp'     => $lp
        ]);

        $this->response = [
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
            'query'   => $query,
            'pager'   => $paging->getPager(),
            'html'    => $html,
        ];
    }
}