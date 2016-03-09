<?php
namespace Platform\Share\Service;

use Kendo\Kernel\KernelService;
use Platform\Feed\Model\Feed;
use Kendo\Content\PosterInterface;
use Platform\Share\Model\Share;


/**
 * Class ShareService
 *
 * @package Share\Service
 */
class ShareService extends KernelService
{
    /**
     * @return int
     */
    public function getAdminStatisticCount()
    {
        return app()->table('platform_share')
            ->select()
            ->count();
    }


    /**
     * @param string          $story
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param                 $origin
     * @param int             $privacyType
     * @param int             $privacyValue
     * @param array           $params
     *
     * @return Feed
     */
    public function add($story = '', PosterInterface $poster, PosterInterface $parent = null, $origin, $privacyType = 1, $privacyValue = 1, $params = [])
    {
        $about = null;
        $content = null;
        $parentShareId = 0;
        $feedId = 0;

        if (null == $parent) {
            $parent = $poster;
        }

        if ($origin instanceof Feed) {
            $content = $origin->getAbout();
            $feedId = $origin->getId();
        } else {
            $content = $origin;
        }

        if (empty($about)) {
            $about = $content;
        }

        if ($about instanceof Share) {
            $parentShareId = $content->getId();
            $about = $about->getAbout();
        }

        $share = new Share([
            'user_id'         => $poster->getUserId(),
            'feed_id'         => 0,
            'story'           => $story,
            'poster_id'       => $poster->getId(),
            'parent_share_id' => (int)$parentShareId,
            'poster_type'     => $poster->getType(),
            'parent_user_id'  => $parent->getUserId(),
            'parent_id'       => $parent->getId(),
            'parent_type'     => $parent->getType(),
            'about_id'        => $about->getId(),
            'about_type'      => $about->getType(),
            'params_text'     => json_encode($params),
            'privacy_type'    => $privacyType,
            'privacy_value'   => $privacyValue,
            'privacy_text'    => json_encode(['view' => ['type' => $privacyType, 'value' => $privacyValue]])
        ]);

        $share->save();

        $feed = app()->feedService()->addItemFeed('share', $share);

        $share->setFeedId($feed->getId());
        $share->save();

        return $feed;
    }
}