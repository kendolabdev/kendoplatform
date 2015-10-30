<?php
namespace Feed\Controller\Ajax;

use Feed\Model\Feed;
use Picaso\Acl\AuthorizationRestrictException;
use Picaso\Content\HasStory;
use Picaso\Content\Poster;
use Picaso\Controller\AjaxController;

/**
 * Class FeedController
 *
 * @package Feed\Controller\Ajax
 */
class FeedController extends AjaxController
{

    /**
     * Cancel inline edit
     */
    public function actionSaveInlineEdit()
    {
        list($type, $id, $status) = $this->request->get('type', 'id', 'statusTxt');
        $feed = \App::find($type, $id);

        if (!$feed instanceof Feed)
            throw new \InvalidArgumentException();

        $about = $feed->getAbout();

        if (!$about instanceof HasStory)
            throw new \InvalidArgumentException();

        $about->setStory($status);

        $about->save();

        $story = $about->getStory();

        $html = '';

        if ($story)
            $html = \App::viewHelper()->decorateStory($story);

        $this->response['html'] = $html;
    }

    /**
     * Cancel inline edit
     */
    public function actionCancelInlineEdit()
    {
        list($type, $id) = $this->request->get('type', 'id');
        $feed = \App::find($type, $id);

        if (!$feed instanceof Feed)
            throw new \InvalidArgumentException();

        $about = $feed->getAbout();

        if (!$about instanceof HasStory)
            throw new \InvalidArgumentException();

        $story = $about->getStory();

        $html = '';

        if ($story)
            $html = \App::viewHelper()->decorateStory($story);

        $this->response['html'] = $html;
    }

    /**
     * Switch subscribe for this post
     */
    public function actionToggleHidden()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $feed = \App::find($type, $id);

        $viewer = \App::auth()->getViewer();

        if (!$feed instanceof Feed)
            throw new \InvalidArgumentException();


        \App::feed()->toggleHidden($viewer->getId(), $feed->getId());

        $hidden = \App::feed()->isHidden($viewer->getId(), $feed->getId());

        $this->response = [
            'html' => $this->partial('base/feed/partial/toggle-hidden', ['hidden' => $hidden])
        ];
    }

    /**
     * Switch subscribe for this post
     */
    public function actionToggleHideTimeline()
    {
        list($type, $id, $profileId, $profileType) = $this->request->get('type', 'id', 'profileId', 'profileType');

        $feed = \App::find($type, $id);

        $profile = \App::find($profileType, $profileId);

        $viewer = \App::auth()->getViewer();

        if (!$feed instanceof Feed)
            throw new \InvalidArgumentException();

        if (!$profile->viewerIsPoster($viewer))
            throw new \InvalidArgumentException();

        \App::feed()->hideOnTimeline($profile, $feed);

        $this->response = [
            'html' => '',
        ];
    }


    /**
     * Switch subscribe for this post
     */
    public function actionToggleSubscribe()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $feed = \App::find($type, $id);

        $viewer = \App::auth()->getViewer();

        if (!$feed instanceof Feed)
            throw new \InvalidArgumentException();

        $about = $feed->getAbout();

        \App::notification()->toggleSubscribe($viewer, $about);

        $subscribed = \App::notification()->isSubscribed($viewer, $about);

        $this->response = [
            'html' => $this->partial('base/feed/partial/toggle-subscribe', ['subscribed' => $subscribed])
        ];
    }


    /**
     * Post update status
     */
    public function actionPost()
    {
        $poster = \App::auth()->getViewer();

        $parent = \App::find($this->request->getString('profileType'), $this->request->getInt('profileId'));

        if (!$parent) {
            $parent = $poster;
        }

        $photoTemp = $this->request->getArray('photoTemp');
        $linkTmp = $this->request->getArray('link');
        $videoTmp = $this->request->getArray('video');
        $attachment = $this->request->getArray('attachment');

        $serviceName = 'feed';

        /**
         * process uploaded photo before check other
         */
        if (!empty($photoTemp)) {
            $serviceName = 'photo';
        }

        if (!empty($videoTmp)) {
            $serviceName = 'video';
        }

        if (!empty($linkTmp)) {
            $serviceName = 'link';
        }


        if (!empty($attachment['type'])) {
            if ($attachment['type'] == 'link' && !empty($linkTmp)) {
                $serviceName = 'link';
            } else if ($attachment['type'] == 'video' && !empty($videoTmp)) {
                $serviceName = 'video';
            }
        }

        $callbackService = \App::service($serviceName);

        if (!method_exists($callbackService, 'addFromActivityComposer')) ;

        $feed = $callbackService->{'addFromActivityComposer'}($this->request, $poster, $parent);

        if (!$feed instanceof Feed) ;

        $this->response['feed'] = $feed->toArray();
    }


    /**
     *
     */
    public function actionOptions()
    {

        $vars = [
            'canEditPost'     => false,
            'canEditPrivacy'  => false,
            'canDelete'       => false,
            'canReport'       => true,
            'canSave'         => false,
            'canHide'         => true,
            'canHideTimeline' => false,
            'canEmbed'        => false,
            'canFollow'       => false,
            'canSubscribe'    => true,
        ];

        list($id, $eid) = $this->request->get('id', 'eid');
        $feed = \App::find('feed', $id);

        $context = [
            'profileId'   => $this->request->getString('profileId'),
            'profileType' => $this->request->getString('profileType'),
            'type'        => $feed->getType(),
            'id'          => $feed->getId(),
            'eid'         => $eid,
            'isMainFeed'  => $this->request->getString('isMainFeed', false),
        ];

        $followService = \App::follow();

        if (!$feed instanceof Feed) ;

        $parent = \App::find($feed->getParentType(), $feed->getParentId());

        $poster = \App::find($feed->getPosterType(), $feed->getPosterId());


        if (!$poster instanceof Poster) ;


        $viewer = \App::auth()->getViewer();

        if (!$viewer)
            return new AuthorizationRestrictException("Login required");


        $about = $feed->getAbout();

        $vars['subscribed'] = \App::notification()->isSubscribed($viewer, $about) ? 1 : 0;
        $vars['hidden'] = \App::feed()->isHidden($viewer->getId(), $feed->getId()) ? 1 : 0;

        if (!$context['isMainFeed'] && !$parent->viewerIsPoster()) {
            $vars['canHideTimeline'] = true;
        }

        /**
         * owner of this post
         */
        if ($poster->getId() == $viewer->getId()) {
            $vars['canFollow'] = false;
            $vars['canReport'] = false;
            $vars['canEditPost'] = true;
            $vars['canDelete'] = true;
        } else {
            $vars['canFollow'] = true;

            if ($followService->isFollowed($viewer, $poster)) {
                $vars['following'] = 1;
                $vars['followLabel'] = \App::text('core.unfollow_$poster', ['$poster' => substr($poster->getTitle(), 0, 15)]);
            } else {
                $vars['following'] = 0;
                $vars['followLabel'] = \App::text('core.follow_$poster', ['$poster' => substr($poster->getTitle(), 0, 15)]);
            }


            if (!in_array($feed->getAboutType(), [
                'activity.story',
                'share'
            ])
            ) {
                $vars['canSave'] = true;
                $vars['saveThisLabel'] = \App::text('core.save_this_' . str_replace('.', '_', $feed->getAboutType()));
            }
        }

        $vars['context'] = $context;
        $vars['jsonContext'] = _escape(json_encode($context));

        /**
         * owner of parent
         */
        if ($viewer->getId() == $parent->getUserId() || $viewer->getId() == $parent->getUserId()) {
            $vars['canDelete'] = true;
            $vars['canEditPrivacy'] = true;
        }

        $vars['simpleAttrs'] = [
            'type' => $feed->getType(),
            'id'   => $feed->getId(),
        ];

        $this->response['vars'] = $vars;
        $this->response['html'] = $this->partial('/base/feed/partial/feed-options', $vars);
    }

    /**
     * Remove activity feed
     */
    public function actionRemove()
    {
        $feed = \App::find('feed', $this->request->getInt('id'));

        if (!$feed instanceof Feed) {
            throw new \InvalidArgumentException();
        }

        \App::feed()->removeFeed($feed);
    }

    /**
     * Load paging data
     */
    public function actionPaging()
    {

        list($query, $minId, $maxId, $mode) = $this->request->get('query', 'minId', 'maxId', 'mode');

        $query['minId'] = $minId;
        $query['maxId'] = $maxId;
        $query['mode'] = $mode;

        $paging = \App::feed()->loadFeedPaging($query);

        $this->response['count'] = $paging->count();
        $this->response['html'] = $this->partial('/base/feed/controller/ajax/feed/load-feeds', [
            'paging' => $paging,
        ]);
    }

    /**
     * Inline edit this post
     */
    public function actionEditInline()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $about = \App::find($type, $id);

        if ($about instanceof Feed)
            $about = $about->getAbout();


        $parent = $about->getParent();

        /**
         * edit form for caculate the data escaption.
         */

        if (!$about instanceof HasStory)
            throw new \InvalidArgumentException();

        $story = $about->getStory();


        $poster = \App::auth()->getViewer();
        $canControlPrivacy = true;

        $privacyButton = \App::html()->create([
            'plugin'    => 'privacyButton',
            'name'      => 'privacy',
            'forParent' => $parent,
            'forPoster' => $poster,
            'size'      => 'default',
            'forAction' => 'share_status',
            'alignment' => 'right',
            'valign'    => 'dropup',
        ]);

        $privacy = \App::relation()->getRelationOptionForSelect($parent, $poster, 'share_status');


        $this->response['html'] = \App::viewHelper()->partial('/base/feed/partial/edit-feed-inline', [
            'about'             => $about,
            'story'             => $story,
            'type'              => $type,
            'id'                => $id,
            'isMainFeed'        => $this->request->getParam('isMainFeed'),
            'profileType'       => $this->request->getParam('profileType'),
            'profileId'         => $this->request->getParam('profileId'),
            'privacy'           => $privacy,
            'privacyButton'     => $privacyButton,
            'txtId'             => uniqid('_mention'),
            'canControlPrivacy' => $canControlPrivacy,
        ]);
    }

}