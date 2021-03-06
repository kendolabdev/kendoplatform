<?php
namespace Platform\Relation\Controller\Ajax;

use Kendo\Content\ContentInterface;
use Kendo\Controller\AjaxController;

/**
 * Class PrivacyController
 *
 * @package Platform\Relation\Controller\Ajax
 */
class PrivacyController extends AjaxController
{
    /**
     *
     */
    public function actionUpdatePrivacy()
    {
        list($type, $id, $eid) = $this->request->getList('type', 'id', 'eid');

        $about = app()->find($type, $id);

        /**
         * Dont have permission
         */
        if (!$about->viewerIsParent())
            throw new \InvalidArgumentException();

        if (!$about instanceof ContentInterface)
            throw new \InvalidArgumentException();

        $privacy = $this->request->getArray('privacy');

        $about->updatePrivacy('view', $privacy['type'], $privacy['value']);

        $this->response = [
            'eid'  => $eid,
            'html' => app()->viewHelper()->labelPrivacy($about)
        ];
    }

    /**
     *
     */
    public function actionEditPrivacyOptions()
    {
        $poster = app()->auth()->getViewer();

        list($type, $id, $eid) = $this->request->getList('type', 'id', 'eid');
        list($accepts, $excludes) = $this->request->getList('accepts', 'excludes');

        $about = app()->find($type, $id);

        $parent = $about->getParent();

        if (!$parent) {
            throw new \InvalidArgumentException("Invalid arguments [parentType, parentId]");
        }


        $forAction = $this->request->getParam('forAction', 'share_status');

        $options = app()->relation()
            ->getPrivacyOptions($poster, $parent, $accepts, $excludes);

        $note = app()->text('core.privacy_note_for_' . $forAction);

        $this->response['html'] = $this->partial('platform/relation/partial/edit-privacy-options', [
            'note'      => $note,
            'forAction' => $forAction,
            'poster'    => $poster,
            'options'   => $options,
            'about'     => $about,
            'eid'       => $eid,
        ]);
    }

    /**
     *
     */
    public function actionOptions()
    {
        $poster = app()->auth()->getViewer();

        list($parentType, $parentId, $eid) = $this->request->getList('parentType', 'parentId', 'eid');
        list($accepts, $excludes) = $this->request->getList('accepts', 'excludes');

        $parent = app()->find($parentType, $parentId);

        if (!$parent) {
            throw new \InvalidArgumentException("Invalid arguments [parentType, parentId]");
        }


        $forAction = $this->request->getParam('forAction', 'share_status');

        $options = app()->relation()
            ->getPrivacyOptions($poster, $parent, $accepts, $excludes);

        $note = app()->text('core.privacy_note_for_' . $forAction);

        $this->response['html'] = $this->partial('platform/relation/partial/privacy-options', [
            'note'      => $note,
            'forAction' => $forAction,
            'poster'    => $poster,
            'options'   => $options,
            'eid'       => $eid,
        ]);
    }

    /**
     *
     */
    public function actionChangeDefault()
    {
        $forAction = $this->request->getParam('forAction', 'share__status');
        $privacy = $this->request->getArray('privacy');


        list($parentType, $parentId) = $this->request->getList('parentType', 'parentId');

        $parent = app()->find($parentType, $parentId);

        if (!$parent) {
            throw new \InvalidArgumentException("Invalid arguments [parentId, parentType]");
        }


        if (empty($privacy) || empty($forAction)) {
            return;
        }

        $poster = app()->auth()->getViewer();

        // check parent is belong to poster

        if (!$parent->viewerIsPoster($poster))
            throw new \InvalidArgumentException("You don have permission to changed this privacy!");

        // valdiate privacy is belong to this owner
        $privacyValue = $privacy['value'];
        $privacyType = $privacy['type'];

        if (app()->relation()->isGenericRelationType($privacyType)) {
            $privacyValue = $privacyType;
        } else if ($privacyType < RELATION_TYPE_CUSTOM) {
            $relation = app()->relation()->findList($parent, $privacyType, true);

            $privacyValue = $relation->getId();
        } else {
            // find by relation id
            $relation = app()->relation()->findById($privacyValue);

            if (!$relation) {
                throw new \InvalidArgumentException("Invalid privacy value");
            }

            if (!$relation->getParentId() == $parent->getId()) {
                throw new \InvalidArgumentException("Invalid privacy value");
            }
            $privacyValue = $relation->getId();
        }

        if (!$parent instanceof ContentInterface)
            throw new \InvalidArgumentException("Target does not support privacy object");

        $parent->updatePrivacy($forAction, $privacyType, $privacyValue);
    }
}