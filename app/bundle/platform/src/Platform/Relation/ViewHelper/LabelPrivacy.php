<?php
namespace Platform\Relation\ViewHelper;

use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;


/**
 * Class LabelPrivacy
 *
 * @package Platform\Relation\ViewHelper
 */
class LabelPrivacy
{
    /**
     * @param $about
     *
     * @return string
     */
    function __invoke($about)
    {
        if (!$about instanceof ContentInterface) return '';

        $value = $about->getPrivacyValue();
        $type = $about->getPrivacyType();
        $icon = 'privacy-custom';

        switch ($type) {
            case RELATION_TYPE_ANYONE:
            case RELATION_TYPE_REGISTERED:
                $icon = 'privacy-public';
                break;
            case RELATION_TYPE_OWNER:
                $icon = 'privacy-private';
                break;
            case RELATION_TYPE_MEMBER:
                $icon = 'privacy-friend';
                break;
            case RELATION_TYPE_MEMBER_OF_MEMBER:
                $icon = 'privacy-friend2';
                break;
        }

        $isOwner = false;

        if (!$about instanceof ContentInterface && !$about instanceof PosterInterface)
            return '';

        if ($about->viewerIsParent()) {

            $isOwner = true;
        }


        return app()->viewHelper()->partial('platform/relation/partial/label-privacy', [
            'about'   => $about,
            'type'    => $type,
            'value'   => $value,
            'icon'    => $icon,
            'isOwner' => $isOwner,
            'label'   => app()->text('core.shared') . ' : ' . app()->relation()->getPrivacyLabel($about),
        ]);
    }

}