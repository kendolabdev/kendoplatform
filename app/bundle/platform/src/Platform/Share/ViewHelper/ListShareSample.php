<?php
namespace Platform\Share\ViewHelper;

use Kendo\Content\ContentInterface;


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
        if (!$about instanceof ContentInterface) {
            return '';
        }

        $total = $about->getShareCount();

        return app()->viewHelper()->partial('platform/share/partial/list-share-sample', [
            'about'    => $about,
            'total'    => $total,
            'modalUrl' => 'ajax/platform/share/share/shared-this/?' . http_build_query($about->toTokenArray(), null, '&')
        ]);
    }
}