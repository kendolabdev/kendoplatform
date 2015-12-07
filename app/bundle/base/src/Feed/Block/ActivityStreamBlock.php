<?php

namespace Feed\Block;

use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Layout\Block;

/**
 * Class ActivityStreamBlock
 *
 * @package Feed\Block
 */
class ActivityStreamBlock extends Block
{

    /**
     *
     */
    public function execute()
    {

        $profileId = null;
        $profileType = null;
        $hashtag = \App::registryService()->get('activity_hashtag');
        $posterId = null;
        $posterType = null;
        $sharedId = null;
        $sharedType = null;


        $poster = \App::authService()->getViewer();

        $profile = \App::registryService()->get('profile');

        if ($profile instanceof PosterInterface) {
            $profileId = $profile->getId();
            $profileType = $profile->getType();
        }

        if ($poster instanceof PosterInterface) {
            $posterType = $poster->getType();
            $posterId = $poster->getId();
        }

        $shared = \App::registryService()
            ->get('activity_shared');

        if ($shared instanceof ContentInterface) {
            $sharedId = $shared->getId();
            $sharedType = $shared->getType();
        }

        $query = [
            'isMainFeed'  => \App::registryService()->get('isMainFeed') ? 1 : 0,
            'profileId'   => $profileId,
            'profileType' => $profileType,
            'posterId'    => $posterId,
            'posterType'  => $posterType,
            'hashtag'     => $hashtag,
            'sharedId'    => $sharedId,
            'sharedType'  => $sharedType,
        ];

        $paging = \App::feedService()->loadFeedPaging($query);

        $containerId = \App::registryService()->get('composerTargetId');

        $this->view->assign([
            'query'       => $query,
            'paging'      => $paging,
            'containerId' => $containerId,
            'lp'          => $this->lp,
        ]);
    }
}