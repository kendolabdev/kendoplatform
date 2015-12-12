<?php
namespace Platform\Share\Controller\Ajax;

use Platform\Feed\Model\Feed;
use Platform\Feed\Model\FeedStatus;
use Kendo\Content\ContentInterface;
use Kendo\Controller\AjaxController;
use Platform\Share\Model\Share;


/**
 * Class ShareController
 *
 * @package Share\Controller\Ajax
 */
class ShareController extends AjaxController
{

    /**
     *
     */
    public function actionModal()
    {
        $origin = null;
        $about = null;
        $story = null;
        $feed = null;
        $type = $this->request->getString('type');
        $id = $this->request->getInt('id');

        $origin = \App::find($type, $id);

        if ($origin instanceof Feed) {
            $about = $origin->getAbout();
            $feed = $origin;
        }

        if ($origin instanceof Share) {
            $about = $origin->getAbout();
        }

        if (empty($about)) {
            $about = $origin;
        }

        $poster = \App::authService()->getViewer();

        /**
         * throw new content exception, you share none attachable content
         */
        if (!$about instanceof ContentInterface) {
            throw new \InvalidArgumentException("Could not share none attachable");
        }

        $story = $about->getStory();

        if ($about instanceof FeedStatus) {
            if (null == $about->getPlace()) {
                $story = null;
            }
        }

        $canShareFacebook = false;
        $canShareMessage = true;
        $canShareFriend = true;
        $canShareGroup = false;
        $canSharePage = true;
        $canShareEvent = true;

        $data = [
            'eid'              => null,
            'about'            => $about,
            'story'            => $story,
            'feed'             => $feed,
            'poster'           => $poster,
            'type'             => $type,
            'id'               => $id,
            'profileId'        => $poster->getId(),
            'profileType'      => $poster->getType(),
            'canShareFacebook' => $canShareFacebook,
            'canShareFriend'   => $canShareFriend,
            'canSharePage'     => $canSharePage,
            'canShareGroup'    => $canShareGroup,
            'canShareMessage'  => $canShareMessage,
            'canShareEvent'    => $canShareEvent,
        ];

        $html = $this->partial('/base/share/dialog/share-modal', $data);
        $this->response = [
            'html'      => $html,
            'directive' => 'update',
        ];

    }

    /**
     * Share an item via feed or item detail
     */
    public function actionAdd()
    {
        $contentTxt = $this->request->getString('contentTxt');

        $id = $this->request->getParam('id');
        $type = $this->request->getParam('type');

        $privacyType = 1;
        $privacyValue = 1;

        $poster = \App::authService()->getViewer();
        $profile = null;
        $profileString = $this->request->getString('profile');

        if (!empty($profileString)) {

            list($profileId, $profileType) = explode('@', $profileString);

            if ($profileId && $profileType) {
                $profile = \App::find($profileType, $profileId);
            }
        }

        if (null == $profile) {
            $profile = $poster;
        }

        $about = \App::find($type, $id);

        $feed = \App::shareService()->add($contentTxt, $poster, $profile, $about, $privacyType, $privacyValue);


        $this->response = ['code' => 200, 'feedId' => $feed->getId()];
    }

    /**
     *
     */
    public function actionSharedThis()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $about = \App::find($type, $id);

        $query = [
            'sharedType' => $about->getType(),
            'sharedId'   => $about->getId(),
        ];

        $paging = \App::feedService()
            ->loadFeedPaging($query);

        $data = [
            'query'       => $query,
            'paging'      => $paging,
            'containerId' => uniqid('_fs')
        ];

        $html = $this->partial('platform/share/controller/ajax/share/shared-this', $data);

        $this->response = [
            'html'      => $html,
            'directive' => 'update',
        ];
    }
}