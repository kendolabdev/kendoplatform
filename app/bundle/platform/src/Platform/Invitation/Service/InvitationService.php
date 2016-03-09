<?php
namespace Platform\Invitation\Service;

use Kendo\Kernel\KernelService;
use Platform\Invitation\Model\Invitation;
use Kendo\Acl\AuthorizationRestrictException;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;

/**
 * Class Platform\InvitationService
 *
 * @package Platform\Invitation\Service
 */
class InvitationService extends KernelService
{

    /**
     * @param $id
     *
     * @return Type
     */
    public function findType($id)
    {
        return app()->table('platform_invitation_type')
            ->findById($id);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadInvitationPaging($query = [], $page = 1, $limit = 12)
    {
        $select = app()->table('platform_invitation')->select();

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
            $select->where('parent_id=?', (string)app()->auth()->getId());
        }

        return $select->paging($page, $limit);
    }

    /**
     * @param PosterInterface $parent
     *
     * @return int
     */
    public function getUnreadRequestCount(PosterInterface $parent = null)
    {
        if (null == $parent) {
            $parent = app()->auth()->getViewer();
        }

        if (!$parent instanceof PosterInterface) return 0;

        return app()->table('platform_invitation')
            ->select()
            ->where('parent_id=?', $parent->getId())
            ->where('`read`=?', 0)
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
            $parent = app()->auth()->getViewer();


        if (!$parent instanceof PosterInterface)
            return 0;

        return app()->table('platform_invitation')
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
            $parent = app()->auth()->getViewer();


        if (!$parent instanceof PosterInterface)
            throw new AuthorizationRestrictException();


        app()->table('platform_invitation')
            ->update(['mitigated' => 1])
            ->where('parent_id=?', $parent->getId())
            ->execute();

    }

    /**
     * Add request from poster to parent
     *
     * @param string           $type
     * @param PosterInterface  $poster
     * @param PosterInterface  $parent
     * @param ContentInterface $object
     *
     * @return \Platform\Invitation\Model\Invitation
     */
    public function addRequest($type, PosterInterface $poster, PosterInterface $parent, ContentInterface $object = null)
    {

        $data = [
            'type_id'        => $type,
            'poster_id'      => $poster->getId(),
            'user_id'        => $poster->getUserId(),
            'parent_id'      => $parent->getId(),
            'parent_user_id' => $parent->getUserId(),
            'poster_type'    => $poster->getType(),
            'parent_type'    => $parent->getType(),
            'created_at'     => KENDO_DATE_TIME,
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
     * @param string          $type
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     */
    public function removeRequest($type, PosterInterface $poster, PosterInterface $parent)
    {
        app()->table('platform_invitation')
            ->delete()
            ->where('type_id=?', $type)
            ->where('poster_id=?', $poster->getId())
            ->where('parent_id=?', $parent->getId())
            ->execute();
    }

    /**
     * @param PosterInterface $parent
     *
     * @return string
     */
    public function requestMembershipType($parent)
    {
        return sprintf('request_membership_%s', $parent->getModuleName());
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return Platform\Invitation
     */
    public function addMembershipRequest(PosterInterface $poster, PosterInterface $parent)
    {
        return $this->addRequest($this->requestMembershipType($parent), $poster, $parent);
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     */
    public function removeMembershipRequest(PosterInterface $poster, PosterInterface $parent)
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
        return app()->table('platform_invitation_type')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }

}