<?php

namespace Base\Feed\Service;

use Base\Feed\Model\Feed;
use Base\Feed\Model\FeedHash;
use Base\Feed\Model\FeedHashtag;
use Base\Feed\Model\FeedHidden;
use Base\Feed\Model\FeedStatus;
use Base\Feed\Model\FeedStream;
use Base\Feed\Model\FeedType;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Request\HttpRequest;
use Base\Share\Model\Share;

/**
 * Class FeedService
 *
 * @package Feed\Service
 */
class FeedService
{

    /**
     * hash tag regular expression
     *
     * @link https://regex101.com
     */
    const HASH_REG = "/#([^\\s\\'\\\"]+)/m";

    /**
     * People tag regular expression
     *
     * @link https://regex101.com
     */
    const PEOPLE_REG = "/\\@\\[([^\\]]+)]\\((\\w+):(\\d+)\\)/m";

    /**
     * default limit length of feed
     */
    const  DEFAULT_LIMIT_FEED = 10;


    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminFeedTypePaging($query = [], $page = 1, $limit = 100)
    {
        $select = \App::table('feed.feed_type')
            ->select();

        if (!empty($query['module'])) {
            $select->where('module_name=?', (string)$query['module']);
        }

        return $select->paging($page, $limit);
    }

    /**
     * @param string $id
     *
     * @return \Base\Feed\Model\FeedType
     */
    public function findFeedTypeById($id)
    {
        return \App::table('feed.feed_type')
            ->findById($id);
    }

    /**
     * @param $viewerId
     * @param $feedId
     *
     * @return FeedHidden
     */
    public function findHidden($viewerId, $feedId)
    {
        return \App::table('feed.feed_hidden')
            ->select()
            ->where('viewer_id=?', (string)$viewerId)
            ->where('feed_id=?', (string)$feedId)
            ->one();
    }


    /**
     * @param $viewerId
     * @param $feedId
     *
     * @return FeedHidden
     */
    public function addHidden($viewerId, $feedId)
    {
        $hidden = new FeedHidden([
            'viewer_id'  => $viewerId,
            'feed_id'    => $feedId,
            'created_at' => KENDO_DATE_TIME,
        ]);

        $hidden->save();

        return $hidden;
    }

    /**
     * @param $viewerId
     * @param $feedId
     *
     */
    public function removeHidden($viewerId, $feedId)
    {
        $hidden = $this->findHidden($viewerId, $feedId);

        if ($hidden)
            $hidden->delete();
    }

    /**
     * @param $viewerId
     * @param $feedId
     *
     * @return bool
     */
    public function toggleHidden($viewerId, $feedId)
    {
        $hidden = $this->findHidden($viewerId, $feedId);

        if ($hidden) {
            $hidden->delete();

            return false;
        } else {
            $this->addHidden($viewerId, $feedId);

            return true;
        }
    }

    /**
     * @param $viewerId
     * @param $feedId
     *
     * @return bool
     */
    public function isHidden($viewerId, $feedId)
    {
        return null != $this->findHidden($viewerId, $feedId);
    }

    /**
     * @param string $type support main, public, parent, poster
     * @param array  $excludes
     *
     * @return array
     */
    public function getFeedTypeShowOnTarget($type, $excludes = null)
    {

        $data = \App::cacheService()
            ->get(['getFeedTypeShowOnTarget', $type], 0, function () use ($type) {
                return $this->_getFeedTypShowOnTarget($type);
            });

        if (empty($excludes))
            return $data;

        return array_diff($data, $excludes);
    }

    /**
     * @param $type
     *
     * @return array
     */
    public function _getFeedTypShowOnTarget($type)
    {
        $select = \App::table('feed.feed_type')
            ->select()
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
            ->where('is_active=?', 1);

        switch ($type) {
            case 'parent':
                $select->where('show_on_parent=?', 1);
                break;
            case 'public':
                $select->where('show_on_public=?', 1);
                break;
            case 'poster':
                $select->where('show_on_poster=?', 1);
                break;
            case 'home':
            case 'main':
                $select->where('show_on_main=?', 1);
                break;
        }

        return $select->fields('feed_type');
    }

    /**
     * @return show_on_* value of activity_feed_type target for active items.
     *
     * @param $feedType
     *
     * @return array
     */
    public function checkFeedTypeTarget($feedType)
    {
        $return = [
            'main'   => false,
            'public' => false,
            'poster' => false,
            'parent' => false,
            'tagged' => false
        ];

        $item = \App::table('feed.feed_type')
            ->select()
            ->where('feed_type=?', (string)$feedType)
            ->one();

        if ($item instanceof FeedType) {
            $return = array_merge($return, [
                'poster' => $item->getShowOnPoster(),
                'main'   => $item->getShowOnMain(),
                'parent' => $item->getShowOnParent(),
                'tagged' => $item->getShowOnTagged(),
                'public' => $item->getShowOnPublic(),
            ]);
        }

        return $return;

    }

    /**
     * @param string $feedType
     *
     * @return bool
     */
    public function hasFeedType($feedType)
    {
        /**
         * check in support module list.
         */
        return \App::table('feed.feed_type')
            ->select()
            ->where('feed_type=?', (string)$feedType)
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
            ->field('feed_id') > 0;
    }

    /**
     * @param ContentInterface $about
     */
    public function updatePrivacy(ContentInterface $about)
    {
        \App::table('feed')
            ->update([
                'privacy_type'  => $about->getPrivacyType(),
                'privacy_value' => $about->getPrivacyValue(),
            ])
            ->where('about_id=?', $about->getId())
            ->where('about_type=?', $about->getType())
            ->execute();

        \App::table('feed.feed_stream')
            ->update([
                'privacy_type'  => $about->getPrivacyType(),
                'privacy_value' => $about->getPrivacyValue(),
            ])
            ->where('about_id=?', $about->getId())
            ->execute();
    }

    /**
     * @param HttpRequest     $request
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return Feed
     */
    public function addFromActivityComposer(HttpRequest $request, PosterInterface $poster, PosterInterface $parent)
    {
        $privacy = $request->getArray('privacy');

        $privacyType = 1;
        $privacyValue = 1;

        if (!empty($privacy)) {
            $privacyType = $privacy['type'];
            $privacyValue = $privacy['value'];
        }
        $statusTxt = $request->getString('statusTxt');

        $status = $this->addStatus($statusTxt, $poster, $parent, $privacyType, $privacyValue);

        $needUpdate = false;

        $place = $request->getArray('place');

        if (!empty($place)) {
            $status->setPlace($place);
            $needUpdate = true;
        }

        $people = $request->getArray('people');

        if (!empty($people)) {
            $status->setPeople($people);
            $needUpdate = true;
        }

        if ($needUpdate) {
            $status->save();
        }

        $feed = $this->addItemFeed('update_status', $status);

        return $feed;
    }

    /**
     * @return int
     */
    public function getAdminStatisticCount()
    {
        return \App::table('feed')
            ->select()
            ->count();
    }


    /**
     * @param array $query
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getPublicFeedSelect($query)
    {
        $select = \App::table('feed')
            ->select('f')
            ->order('f.feed_id', -1)
            ->where('f.privacy_type=?', RELATION_TYPE_ANYONE);

        /**
         * apply select
         */
        $this->applyOptionsToSelect($select, $query, 'public');

        return $select;
    }

    /**
     * @param string $tagId
     * @param array  $query
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getPublicTaggedFeedSelect($tagId, $query)
    {
        $hashTable = \App::table('feed.feed_hashtag')
            ->getName();

        $select = \App::table('feed')
            ->select('f')
            ->join($hashTable, 'h', 'h.feed_id=f.feed_id', null, null)
            ->order('f.feed_id', -1)
            ->where('h.hash_id=?', $tagId)
            ->where('f.privacy_type=?', RELATION_TYPE_ANYONE);

        /**
         * apply select
         */
        $this->applyOptionsToSelect($select, $query, null);

        return $select;
    }

    /**
     * @param string $viewerId
     * @param string $alias
     *
     * @return string
     */
    public function getHiddenConditionString($viewerId, $alias = 'f')
    {
        return strtr('f.feed_id NOT IN (SELECT feed_id FROM :prefix_feed_hidden WHERE viewer_id=:viewerId)',
            [':prefix_'  => \App::db()->getPrefix(),
             ':viewerId' => $viewerId,
             ':alias'    => $alias,]
        );
    }

    /**
     * @param PosterInterface $viewer
     * @param int             $tagId
     * @param array           $query
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getTaggedFeedSelect(PosterInterface $viewer, $tagId, $query)
    {
        $tagTable = \App::table('feed.feed_hashtag')->getName();

        $relationCondition = \App::relationService()->getPrivacyConditionForQuery($viewer->getId(), 'f');

        $select = \App::table('feed')
            ->select('f')
            ->join($tagTable, 'h', 'h.feed_id=f.feed_id', null, null)
            ->order('f.feed_id', -1)
            ->where('h.hash_id=?', $tagId)
            ->where($relationCondition, null);

        /**
         * extra condition for search
         */

        $this->applyOptionsToSelect($select, $query, null);

        return $select;
    }


    /**
     * @param array $query
     *
     * @return array
     */
    public function getPublicFeeds($query)
    {
        $select = $this->getPublicFeedSelect($query);

        return $select->all();
    }

    /**
     * @param PosterInterface $viewer
     * @param array           $query
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getMainFeedSelect(PosterInterface $viewer, $query)
    {
        $followIdList = \App::followService()->getFollowedIdList($viewer->getId());

        $relationCondition = \App::relationService()->getPrivacyConditionForQuery($viewer->getId(), 'f');

        $select = \App::table('feed')
            ->select('f')
            ->order('f.feed_id', -1)
            ->where('f.poster_id IN ?', $followIdList)
            ->where($this->getHiddenConditionString($viewer->getId(), 'f'))
            ->where($relationCondition, null);

        /**
         * extra condition for search
         */

        $this->applyOptionsToSelect($select, $query, 'main');

        return $select;
    }

    /**
     * @param \Kendo\Db\SqlSelect $select
     * @param array                $query
     * @param string               $type
     *
     * @return bool
     */
    public function applyOptionsToSelect(&$select, $query, $type = null)
    {

        $needToFilterType = true;

        if (!empty($query['mode'])) {
            $mode = $query['mode'];

            if ($mode == 'new') {
                if (!empty($query['maxId'])) {
                    $select->where('f.feed_id > ?', $query['maxId']);
                }
            } else if ($mode == 'more') {
                if (!empty($query['minId'])) {
                    $select->where('f.feed_id < ?', $query['minId']);
                }
            } else if (!empty($query['feedId'])) {

                /**
                 * Select feed if does not require other kinds.
                 */
                $needToFilterType = false;

                if (is_array($query['feedId'])) {
                    $select->where('f.feed_id IN  ?', $query['feedId']);
                } else {
                    $select->where('f.feed_id = ?', $query['feedId']);
                }
            }
        }

        if ($needToFilterType && $type) {

            $feedTypes = $this->getFeedTypeShowOnTarget($type);

            if (!empty($feedTypes)) {
                $select->where('f.feed_type IN ?', $feedTypes);
            }
        }

        $limit = !empty($query['limit']) ? intval($query['limit']) : 0;


        $select->limit($limit < 1 ? self::DEFAULT_LIMIT_FEED : $limit, 0);
    }

    /**
     * @param PosterInterface $viewer
     * @param array           $options
     *
     * @return array
     */
    public function getMainFeeds(PosterInterface $viewer, $options)
    {
        $select = $this->getMainFeedSelect($viewer, $options);

        return $select->all();
    }

    /**
     * @param PosterInterface $poster
     * @param        $tagId
     * @param        $options
     *
     * @return array
     */
    public function getTaggedFeeds(PosterInterface $poster = null, $tagId, $options)
    {

        if ($poster) {
            $select = $this->getTaggedFeedSelect($poster, $tagId, $options);
        } else {
            $select = $this->getPublicTaggedFeedSelect($tagId, $options);
        }

        return $select->all();
    }

    /**
     * @param ContentInterface $about
     * @param         $options
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getPublicSharedFeedSelect(ContentInterface $about, $options)
    {
        $select = \App::table('share')
            ->select('f')
            ->order('f.feed_id', -1)
            ->where('feed_id>?', 0)
            ->where('f.privacy_type = ?', RELATION_TYPE_ANYONE);

        if ($about instanceof Share) {
            $select->where('parent_share_id=?', $about->getId());
        } else {
            $select->where('about_id=?', $about->getId());
        }
        /**
         * apply select
         */
        $this->applyOptionsToSelect($select, $options, null);

        $feedIdList = $select->toInts('feed_id');

        if (empty($feedIdList)) {
            $feedIdList[] = -1;
        }

        return \App::table('feed')
            ->select('f')
            ->where('f.feed_id IN ? ', $feedIdList)
            ->order('f.feed_id', -1);
    }

    /**
     * @param PosterInterface  $viewer
     * @param ContentInterface $about
     * @param         $options
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getSharedFeedSelect(PosterInterface $viewer, $about, $options)
    {

        $relationCondition = \App::relationService()->getPrivacyConditionForQuery($viewer->getId(), 'f');

        $select = \App::table('share')
            ->select('f')
            ->order('f.feed_id', -1)
            ->where('feed_id>?', 0)
            ->where('f.privacy_type = ?', RELATION_TYPE_ANYONE)
            ->where($relationCondition, null);

        if ($about instanceof Share) {
            $select->where('parent_share_id=?', $about->getId());
        } else {
            $select->where('about_id=?', $about->getId());
        }
        /**
         * apply select
         */
        $this->applyOptionsToSelect($select, $options, null);

        $feedIdList = $select->toInts('feed_id');

        if (empty($feedIdList)) {
            $feedIdList[] = -1;
        }

        return \App::table('feed')
            ->select('f')
            ->where('f.feed_id IN ? ', $feedIdList)
            ->order('f.feed_id', -1);
    }

    /**
     * @param PosterInterface|null $viewer
     * @param ContentInterface     $about
     * @param             $options
     *
     * @return array
     */
    public function getSharedFeeds(PosterInterface $viewer = null, ContentInterface $about, $options)
    {
        if (null == $viewer) {
            $select = $this->getPublicSharedFeedSelect($about, $options);
        } else {
            $select = $this->getSharedFeedSelect($viewer, $about, $options);
        }

        return $select->all();
    }


    /**
     * @param PosterInterface $profile
     * @param array           $query
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getPublicProfileFeedSelect(PosterInterface $profile, $query)
    {
        $select = \App::table('feed.feed_stream')
            ->select('f')
            ->where('f.profile_id=?', $profile->getId())
            ->where('f.privacy_value=?', 1)
            ->where('f.is_hidden=?', 0)
            ->order('f.feed_id', -1)// anyone public only
        ;

        /**
         * extra condition for search
         */
        $this->applyOptionsToSelect($select, $query, null);

        $feedIdList = $select->toInts('feed_id');

        if (empty($feedIdList)) {
            $feedIdList[] = -1;
        }

        return \App::table('feed')
            ->select('f')
            ->where('f.feed_id IN ? ', $feedIdList)
            ->order('f.feed_id', -1);
    }

    /**
     * @param PosterInterface $profile
     * @param PosterInterface $viewer
     * @param array           $query
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getProfileFeedSelect(PosterInterface $profile, PosterInterface $viewer, $query)
    {
        $relationCondition = \App::relationService()->getPrivacyConditionForQuery($viewer->getId(), 'f');

        $select = \App::table('feed.feed_stream')
            ->select('f')
            ->where('f.profile_id=?', $profile->getId())
            ->where('f.is_hidden=?', 0)
            ->where($relationCondition, null)
            ->where($this->getHiddenConditionString($viewer->getId(), 'f'))
            ->order('f.feed_id', -1);

        /**
         * extra condition for search
         */
        $this->applyOptionsToSelect($select, $query);

        $feedIdList = $select->toInts('feed_id');


        if (empty($feedIdList)) {
            $feedIdList[] = -1;
        }

        return \App::table('feed')
            ->select('f')
            ->where('f.feed_id in ?', $feedIdList)
            ->order('f.feed_id', -1);

    }

    /**
     * @param array $feedIdList
     *
     * @return array
     */
    public function getFeedByIdList($feedIdList)
    {
        return \App::table('feed')
            ->select()
            ->where('feed_id IN ?', $feedIdList)
            ->order('feed_id', -1)
            ->all();
    }

    /**
     * @param PosterInterface $profile
     * @param PosterInterface $viewer
     * @param array           $options
     *
     * @return array
     */
    public function getProfileFeeds(PosterInterface $profile, PosterInterface $viewer = null, $options)
    {
        $select = null;

        if (null == $viewer) {
            $select = $this->getPublicProfileFeedSelect($profile, $options);
        } else {
            $select = $this->getProfileFeedSelect($profile, $viewer, $options);
        }

        return $select->all();
    }

    /**
     * @param $story
     *
     * @return array|null
     */
    public function getHashTagsInStory($story)
    {
        if (preg_match_all(self::HASH_REG, $story, $all)) {
            return $all[1];
        }

        return null;
    }

    /**
     * @param string $tag
     *
     * @return int
     */
    public function getHashTagId($tag)
    {
        if (empty($tag)) return 0;

        $id = \App::table('feed.hash')
            ->select()
            ->where('name=?', (string)$tag)
            ->field('hash_id');

        if (empty($id)) {
            $hash = new FeedHash(['name' => $tag]);
            $hash->save();
            $id = $hash->getId();
        }

        return $id;
    }

    /**
     * @param Feed $feed
     */
    public function clearHashTag(Feed $feed)
    {
        \App::table('feed.feed_hashtag')
            ->delete()
            ->where('feed_id=?', $feed->getId())
            ->execute();
    }

    /**
     * @param Feed   $feed
     * @param string $tag
     *
     * @return bool
     */
    public function addHashTag(Feed $feed, $tag)
    {
        $id = $this->getHashTagId($tag);

        if (empty($id)) return false;

        $tag = new FeedHashtag([
            'feed_id' => $feed->getId(),
            'hash_id' => $id,
        ]);

        $tag->save();

        return true;
    }

    /**
     * Hide an feed on timeline
     *
     * @param PosterInterface $parent
     * @param Feed            $feed
     */
    public function hideOnTimeline(PosterInterface $parent, Feed $feed)
    {
        $stream = \App::table('feed.feed_stream')
            ->select()
            ->where('profile_id=?', $parent->getId())
            ->where('feed_id=?', $feed->getId())
            ->one();

        if ($stream) {
            $stream->setHidden(1);
            $stream->save();
        }


    }

    /**
     * @param string           $feedType
     * @param ContentInterface $about
     * @param array            $params
     *
     * @return Feed
     * @throws \InvalidArgumentException
     */
    public function addItemFeed($feedType, ContentInterface $about, $params = [])
    {
        list($privacyType, $privacyValue) = $about->getPrivacy('view');

        $poster = \App::find($about->getPosterType(), $about->getPosterId());
        $parent = \App::find($about->getParentType(), $about->getParentId());

        $story = null;
        $hashtag = null;
        $peopletag = null;
        $story = $about->getStory();
        $peopletag = $about->getPeople();

        if (!empty($story)) {
            $hashtag = $this->getHashTagsInStory($story);
        }

        // parse story content to load hash tags.


        $feed = new Feed([
            'feed_type'     => $feedType,
            'poster_id'     => $about->getPosterId(),
            'poster_type'   => $about->getPosterType(),
            'parent_id'     => $about->getParentId(),
            'parent_type'   => $about->getParentType(),
            'about_id'      => $about->getId(),
            'about_type'    => $about->getType(),
            'privacy_type'  => (int)$privacyType,
            'privacy_value' => (int)$privacyValue,
            'created_at'    => KENDO_DATE_TIME,
            'params_text'   => json_encode($params),
        ]);

        $feed->save();

        $feed->validate(true, false);

        /**
         * add feed to hashtag list
         */
        if (!empty($hashtag)) {
            foreach ($hashtag as $tag) {
                $this->addHashTag($feed, $tag);
            }
        }

        $this->putFeedToStream($feed, $poster, $parent, $peopletag);

        \App::notificationService()->subscribe($poster, $about);

        return $feed;
    }


    /**
     * @param string          $status
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param int             $privacyType
     * @param int             $privacyValue
     *
     * @return FeedStatus
     */
    public function addStatus($status, PosterInterface $poster, PosterInterface $parent = null, $privacyType, $privacyValue)
    {

        if (!$parent->viewerIsParent()) {
            list($privacyType, $privacyValue) = $parent->getPrivacy('activity__share_status');
        }

        $privacyText = json_encode([
            'view' => [
                'type'  => $privacyType,
                'value' => $privacyValue,
            ],
        ]);

        $status = new FeedStatus([
            'poster_id'      => $poster->getId(),
            'user_id'        => $poster->getUserId(),
            'parent_id'      => $parent->getId(),
            'parent_user_id' => $parent->getUserId(),
            'poster_type'    => $poster->getType(),
            'parent_type'    => $parent->getType(),
            'story'          => (string)$status,
            'privacy_type'   => $privacyType,
            'privacy_value'  => $privacyValue,
            'privacy_text'   => $privacyText,
            'created_at'     => KENDO_DATE_TIME,
            'modified_at'    => KENDO_DATE_TIME
        ]);

        $status->save();

        return $status;
    }

    /**
     * delete feed
     *
     * @param Feed $feed
     *
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    public function removeFeed(Feed $feed)
    {
        $parent = \App::find($feed->getParentType(), $feed->getParentId());

        $poster = \App::find($feed->getPosterType(), $feed->getPosterId());

        if (!$parent instanceof PosterInterface) {
            throw new \InvalidArgumentException("Invalid feed parent");
        }

        if (!$poster instanceof PosterInterface) {
            throw new \InvalidArgumentException("Invalid feed poster");
        }

        $canDelete = false;

        if ($feed->getAbout()->viewerIsPosterOrParent())
            $canDelete = true;

        if (!$canDelete)
            throw new \InvalidArgumentException("You don't have permission to delete this post.");

        $feed->delete();

        // delete related data
        \App::table('feed.feed_stream')
            ->delete()
            ->where('feed_id=?', $feed->getId())
            ->execute();

        return true;

    }


    /**
     * @param Feed            $feed
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param array           $tagged
     *
     * @throws \InvalidArgumentException
     */
    public function putFeedToStream(Feed $feed, PosterInterface $poster, PosterInterface $parent, $tagged = [])
    {
        $insertedIdList = [];

        $checked = $this->checkFeedTypeTarget($feed->getFeedType());

        if ($checked['poster'] && empty($insertedIdList[ $poster->getId() ])) {
            $insertedIdList[ $poster->getId() ] = 1;
            $this->putFeedToProfile($feed, $poster);
        }

        if ($checked['parent'] && empty($insertedIdList[ $parent->getId() ])) {
            $insertedIdList[ $parent->getId() ] = 1;
            $this->putFeedToProfile($feed, $parent);
        }

        if ($checked['tagged'] && !empty($tagged)) {
            foreach ($tagged as $people) {
                if (!$people instanceof PosterInterface) {
                    throw new \InvalidArgumentException("Invalid parameters");
                }

                if (isset($insertedIdList[ $people->getId() ])) {
                    continue;
                }

                $insertedIdList[ $people->getId() ] = 1;

                $this->putFeedToProfile($feed, $people);
            }
        }
    }

    /**
     * @param Feed            $feed
     * @param PosterInterface $profile
     *
     * @return FeedStream
     */
    private function putFeedToProfile(Feed $feed, PosterInterface $profile)
    {
        $stream = new FeedStream([
            'feed_id'       => $feed->getId(),
            'feed_type'     => $feed->getFeedType(),
            'poster_id'     => $feed->getPosterId(),
            'about_id'      => $feed->getAboutId(),
            'parent_id'     => $feed->getParentId(),
            'privacy_value' => $feed->getPrivacyValue(),
            'privacy_type'  => $feed->getPrivacyType(),
            'profile_id'    => $profile->getId(),
            'profile_type'  => $profile->getType()
        ]);
        $stream->save();


        return $stream;
    }

    /**
     * @param  string $story
     *
     * @return string
     */
    public function decorateStory($story)
    {
        if (empty($story)) return '';


        $baseUrl = KENDO_BASE_URL;

        $response = $story;

        $response = preg_replace(self::PEOPLE_REG, "<a href=\"{$baseUrl}ref/$2/$3\" data-hover=\"card\" data-card=\"$3@$2\">$1</a>", $response);
        $response = preg_replace(self::HASH_REG, "<a href=\"{$baseUrl}hashtag?q=$1\">#$1</a>", $response);

        return nl2br($response);
    }

    /**
     * @param $people
     *
     * @return string
     */
    public function decorateTagPeople($people)
    {
        if (empty($people)) {
            return '';
        }

        $array = [];

        foreach ($people as $item) {
            if (!$item instanceof PosterInterface) continue;

            $array[] = sprintf('<a href="%s" class="profile tag" data-hover="card" data-card="%s">%s</a>', $item->toHref(), $item->toToken(), $item->getTitle());
        }

        return implode(', ', $array);
    }

    /**
     * @param array $query [profileType, profileId, posterType, posterId, minId: int, maxId: int]
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadFeedPaging($query)
    {

        $viewer = null;
        $profile = null;
        $profileId = null;
        $profileType = null;
        $shared = null;
        $bundles = [];


        if (!empty($query['profileType']) && !empty($query['profileId'])) {
            $profile = \App::find($query['profileType'], $query['profileId']);
        }

        if (!empty($query['posterType']) && !empty(!$query['posterId'])) {
            $viewer = \App::find($query['posterType'], $query['posterId']);
        }

        if (!empty($query['sharedType']) && !empty($query['sharedId'])) {
            $shared = \App::find($query['sharedType'], $query['sharedId']);
        }

        if (empty($viewer))
            $viewer = \App::authService()->getViewer();

        if ($profile) {
            $profileId = $profile->getId();
            $profileType = $profile->getType();
        }

        $isMainFeed = !empty($query['isMainFeed']) ? $query['isMainFeed'] : 0;


        $feeds = null;

        if (!empty($query['feedIdList'])) {
            $feeds = $this->getFeedByIdList($query['feedIdList']);
        } else if ($shared instanceof ContentInterface) {
            $feeds = $this->getSharedFeeds($viewer, $shared, $query);
        } else if (!empty($query['hashtag'])) {
            $tagId = $this->getHashTagId($query['hashtag']);
            $feeds = $this->getTaggedFeeds($viewer, $tagId, $query);
        } else if (!$profile) {
            if (null != $viewer) {
                $feeds = $this->getMainFeeds($viewer, $query);
            } else {
                $feeds = $this->getPublicFeeds($query);
            }
        } else {
            if ($isMainFeed) {
                $feeds = $this->getMainFeeds($viewer, $query);
            } else {
                $feeds = $this->getProfileFeeds($profile, $viewer, $query);
            }
        }

        $limitCommentCount = (int)\App::setting('activity', 'comment_limit', 3);
        $commentService = \App::commentService();
        $likeService = \App::likeService();


        /**
         * @return array
         */
        foreach ($feeds as $index => $feed) {

            if (!$feed instanceof Feed) continue;

            $about = $feed->getAbout();

            if (!$about) continue;

            $remainCommentCount = 0;

            if ($about instanceof ContentInterface) {
                if ($about->getCommentCount() > $limitCommentCount) {
                    $remainCommentCount = $about->getCommentCount() - $limitCommentCount;
                }
            }

            $place = null;
            $story = null;
            $people = null;
            $shareCount = null;
            $story = $about->getStory();
            $people = $this->decorateTagPeople($about->getPeople());
            $place = $about->getPlace();
            $shareCount = $about->getShareCount();


            $context = [
                'isMainFeed'  => $isMainFeed ? 1 : 0,
                'id'          => $feed->getId(),
                'aboutId'     => $about->getId(),
                'aboutType'   => $about->getType(),
                'profileId'   => $profileId,
                'profileType' => $profileType,
            ];

            $hasAttachment = true;

            if ($about instanceof FeedStatus) {
                if (!$about->getPlaceId()) {
                    $hasAttachment = false;
                }
            }

            $bundles[ $index ] = [
                'feed'               => $feed,
                'place'              => $place,
                'hasStory'           => !empty($story),
                'story'              => $story,
                'people'             => $people,
                'context'            => $context,
                'hasAttachment'      => $hasAttachment,
                'attachmentId'       => $about->getId(),
                'shareCount'         => $shareCount,
                'about'              => $about,
                'poster'             => $about->getPoster(),
                'commentList'        => $commentService->getCommentList($about, 0, 0, $limitCommentCount),
                'limitCommentCount'  => $limitCommentCount,
                'remainCommentCount' => $remainCommentCount,
                'like'               => $likeService->getLikeResult(null, $about, 2),
            ];
        }

        $paging = \App::pagingService()->factory($bundles);

        $paging->noLimit();

        return $paging;
    }


    /**
     * @param ContentInterface $about
     *
     * @return array
     */
    public function loadAboutBundles(ContentInterface $about)
    {
        $limitCommentCount = 3;
        $remainCommentCount = 0;
        $poster = \App::authService()->getViewer();

        $commentService = \App::commentService();
        $likeService = \App::likeService();

        if ($about instanceof ContentInterface) {
            if ($about->getCommentCount() > $limitCommentCount) {
                $remainCommentCount = $about->getCommentCount() - $limitCommentCount;
            }
        }

        $place = null;
        $story = null;
        $people = null;
        $shareCount = null;
        $story = $about->getStory();

        $people = $this->decorateTagPeople($about->getPeople());
        $place = $about->getPlace();
        $shareCount = $about->getShareCount();


        return [
            'place'              => $place,
            'hasStory'           => !empty($story),
            'story'              => $story,
            'people'             => $people,
            'hasAttachment'      => !($about instanceof FeedStatus),
            'attachmentId'       => $about->getId(),
            'about'              => $about,
            'shareCount'         => $shareCount,
            'poster'             => $about->getPoster(),
            'commentList'        => $commentService->getCommentList($about, 0, 0, $limitCommentCount),
            'limitCommentCount'  => $limitCommentCount,
            'remainCommentCount' => $remainCommentCount,
            'like'               => $likeService->getLikeResult($poster, $about, 2),
        ];
    }

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListTypeByModuleName($moduleList)
    {
        return \App::table('feed.feed_type')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }
}