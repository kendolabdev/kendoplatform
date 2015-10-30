<?php

namespace Feed\Block;

use Picaso\Content\Content;
use Picaso\Content\Poster;
use Picaso\Layout\Block;

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
        $hashtag = \App::registry()->get('activity_hashtag');
        $posterId = null;
        $posterType = null;
        $sharedId = null;
        $sharedType = null;


        $poster = \App::auth()->getViewer();

        $profile = \App::registry()->get('profile');

        if ($profile instanceof Poster) {
            $profileId = $profile->getId();
            $profileType = $profile->getType();
        }

        if ($poster instanceof Poster) {
            $posterType = $poster->getType();
            $posterId = $poster->getId();
        }

        $shared = \App::registry()
            ->get('activity_shared');

        if ($shared instanceof Content) {
            $sharedId = $shared->getId();
            $sharedType = $shared->getType();
        }

        $query = [
            'isMainFeed'  => \App::registry()->get('isMainFeed') ? 1 : 0,
            'profileId'   => $profileId,
            'profileType' => $profileType,
            'posterId'    => $posterId,
            'posterType'  => $posterType,
            'hashtag'     => $hashtag,
            'sharedId'    => $sharedId,
            'sharedType'  => $sharedType,
        ];

        $paging = \App::feed()->loadFeedPaging($query);

        $containerId = \App::registry()->get('composerTargetId');

        $this->view->assign([
            'query'       => $query,
            'paging'      => $paging,
            'containerId' => $containerId,
            'lp'          => $this->lp,
        ]);
    }
}