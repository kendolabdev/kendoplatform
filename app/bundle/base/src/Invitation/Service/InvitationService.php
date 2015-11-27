<?php
namespace Invitation\Service;

use Invitation\Model\Invitation;
use Invitation\Model\Type;
use Picaso\Acl\AuthorizationRestrictException;
use Picaso\Content\Content;
use Picaso\Content\Poster;

/**
 * Class InvitationService
 *
 * @package Invitation\Service
 */
class InvitationService
{

    /**
     * @param $id
     *
     * @return Type
     */
    public function findType($id)
    {
        return \App::table('invitation.type')
            ->findById($id);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadInvitationPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('invitation')->select();

        $isValid = false;

        if (!empty($query['parentId'])) {
            $select->where('parent_id=?', $query['parentId']);
            $isValid = true;
        }

        if (!empty($query['posterId'])) {
            $select->where('poster_id=?', $query['posterId']);
            $isValid = true;
        }

        if (!$isValid) {
            $select->where('parent_id=?', (string)\App::authService()->getId());
        }

        return $select->paging($page, $limit);
    }

    /**
     * @param Poster $parent
     *
     * @return int
     */
    public function getUnreadRequestCount(Poster $parent = null)
    {
        if (null == $parent) {
            $parent = \App::authService()->getViewer();
        }

        if (!$parent instanceof Poster) return 0;

        return \App::table('invitation')
            ->select()
            ->where('parent_id=?', $parent->getId())
            ->where('`read`=?', 0)
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
            $parent = \App::authService()->getViewer();


        if (!$parent instanceof Poster)
            return 0;

        return \App::table('invitation')
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
            $parent = \App::authService()->getViewer();


        if (!$parent instanceof Poster)
            throw new AuthorizationRestrictException();


        \App::table('invitation')
            ->update(['mitigated' => 1])
            ->where('parent_id=?', $parent->getId())
            ->execute();

    }

    /**
     * Add request from poster to parent
     *
     * @param string  $type
     * @param Poster  $poster
     * @param Poster  $parent
     * @param Content $object
     *
     * @return Invitation
     */
    public function addRequest($type, Poster $poster, Poster $parent, Content $object = null)
    {

        $data = [
            'type_id'        => $type,
            'poster_id'      => $poster->getId(),
            'user_id'        => $poster->getUserId(),
            'parent_id'      => $parent->getId(),
            'parent_user_id' => $parent->getUserId(),
            'poster_type'    => $poster->getType(),
            'parent_type'    => $parent->getType(),
            'created_at'     => PICASO_DATE_TIME,
        ];

        if (null != $object) {
            $data = array_merge($data, [
                'object_id'   => $object->getId(),
                'object_type' => $object->getType(),
            ]);
        }

        $request = new Invitation($data);

        $request->save();

        return $request;
    }

    /**
     * Remove all request type $type from poster to parent
     *
     * @param string $type
     * @param Poster $poster
     * @param Poster $parent
     */
    public function removeRequest($type, Poster $poster, Poster $parent)
    {
        \App::table('invitation')
            ->delete()
            ->where('type_id=?', $type)
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id=?', $parent->getId())
            ->execute();
    }

    /**
     * @param Poster $parent
     *
     * @return string
     */
    public function requestMembershipType($parent)
    {
        return sprintf('request_membership_%s', $parent->getModuleName());
    }

    /**
     * @param Poster $poster
     * @param Poster $parent
     *
     * @return Invitation
     */
    public function addMembershipRequest(Poster $poster, Poster $parent)
    {
        return $this->addRequest($this->requestMembershipType($parent), $poster, $parent);
    }

    /**
     * @param Poster $poster
     * @param Poster $parent
     */
    public function removeMembershipRequest(Poster $poster, Poster $parent)
    {
        $this->removeRequest($this->requestMembershipType($parent), $poster, $parent);
    }

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListTypeByModuleName($moduleList)
    {
        return \App::table('invitation.invitation_type')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }

}