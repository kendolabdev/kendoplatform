<?php
namespace Share\ViewHelper;

use Picaso\Content\CanShare;


/**
 * Class ListShareSample
 *
 * @package Share\ViewHelper
 */
class ListShareSample
{

    /**
     * @param $about
     *
     * @return string
     */
    function __invoke($about)
    {
        if (!$about instanceof CanShare) {
            return '';
        }

        $total = $about->getShareCount();

        return \App::viewHelper()->partial('base/share/partial/list-share-sample', [
            'about'    => $about,
            'total'    => $total,
            'modalUrl' => 'ajax/share/share/shared-this/?' . http_build_query($about->toTokenArray(), null, '&')
        ]);
    }
}