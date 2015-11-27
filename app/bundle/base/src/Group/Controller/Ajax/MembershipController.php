<?php
namespace Group\Controller\Ajax;

use Group\Model\Group;
use Picaso\Content\Poster;
use Picaso\Controller\AjaxController;

/**
 * Class MembershipController
 *
 * @package Group\Controller\Ajax
 */
class MembershipController extends AjaxController
{
    /**
     * Send request
     *
     * @param string $method
     */
    private function doPosterAction($method)
    {
        $type = 'group';
        $id = $this->request->getString('id');

        $group = \App::find($type, $id);

        if (!$group instanceof Group) {
            throw new \InvalidArgumentException("Invalid group");
        }

        $poster = \App::authService()->getViewer();

        if (!$poster instanceof Poster) {
            throw new \InvalidArgumentException("Only member can member of request");
        }

        \App::groupService()->membership()->{$method}($poster, $group);

        $this->response['html'] = $group->btnMembership();

    }

    /**
     * Send request
     *
     * @param string $method
     */
    private function doManagerAction($method)
    {
        $type = 'group';
        $id = $this->request->getString('id');

        $itemId = $this->request->getString('itemId');
        $itemType = $this->request->getString('itemType');

        $context = $this->request->getString('context', 'label');

        $group = \App::find($type, $id);

        $item = \App::find($itemType, $itemId);

        if (!$group instanceof Group) {
            throw new \InvalidArgumentException("Invalid group");
        }

        /**
         * Validate item
         */
        if (!$item instanceof Poster) {
            throw new \InvalidArgumentException("Invalid group");
        }

        $poster = \App::authService()->getViewer();

        if (!$poster instanceof Poster) {
            throw new \InvalidArgumentException("Only member can member of request");
        }

        $groupService = \App::groupService();


        $groupService->membership()->{$method}($item, $group);

        $membership = $groupService->membership()->getMembershipStatus($item, $group);

        switch ($context) {
            case 'btn':
            case 'button':
                $this->response['html'] = \App::viewHelper()->partial('/base/group/partial/button-manage-membership',
                    [
                        'for'        => $item,
                        'item'       => $group,
                        'membership' => $membership,
                    ]);

            case 'label':
                break;
        }

    }

    /**
     * Join group request
     */
    public function actionJoin()
    {
        $this->doPosterAction('sendMembershipRequest');
    }

    /**
     * Cancel request
     */
    public function actionCancel()
    {
        $this->doPosterAction('cancelMembershipRequest');
    }


    public function actionIgnore()
    {
        $this->doManagerAction('cancelMembershipRequest');
    }

    public function actionAccept()
    {
        $this->doManagerAction('acceptMembershipRequest');
    }

    public function actionRemove()
    {
        $this->doManagerAction('removeMembership');
    }

    public function actionAdd()
    {
        $this->doManagerAction('addMembership');
    }
}