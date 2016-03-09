<?php

namespace Platform\Feed\Block;

use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Layout\BlockController;

/**
 * Class ActivityStreamBlock
 *
 * @package Feed\Block
 */
class ActivityStreamBlock extends BlockController
{

    /**
     *
     */
    public function execute()
    {

        $profileId = null;
        $profileType = null;
        $hashtag = app()->registryService()->get('activity_hashtag');
        $posterId = null;
        $posterType = null;
        $sharedId = null;
        $sharedType = null;


        $poster = app()->auth()->getViewer();

        $profile = app()->registryService()->get('profile');

        if ($profile instanceof PosterInterface) {
            $profileId = $profile->getId();
            $profileType = $profile->getType();
        }

        if ($poster instanceof PosterInterface) {
            $posterType = $poster->getType();
            $posterId = $poster->getId();
        }

        $shared = app()->registryService()
            ->get('activity_shared');

        if ($shared instanceof ContentInterface) {
            $sharedId = $shared->getId();
            $sharedType = $shared->getType();
        }

        $query = [
            'isMainFeed'  => app()->registryService()->get('isMainFeed') ? 1 : 0,
            'profileId'   => $profileId,
            'profileType' => $profileType,
            'posterId'    => $posterId,
            'posterType'  => $posterType,
            'hashtag'     => $hashtag,
            'sharedId'    => $sharedId,
            'sharedType'  => $sharedType,
        ];

        $paging = app()->feedService()->loadFeedPaging($query);

        $containerId = app()->registryService()->get('composerTargetId');

        $this->view->assign([
            'query'       => $query,
            'paging'      => $paging,
            'containerId' => $containerId,
            'lp'          => $this->lp,
        ]);
    }
}