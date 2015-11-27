<?php
namespace Relation\ViewHelper;

use Picaso\Content\Content;
use Picaso\Content\HasPrivacy;
use Picaso\Content\Poster;


/**
 * Class LabelPrivacy
 *
 * @package Relation\ViewHelper
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
        if (!$about instanceof HasPrivacy) return '';

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

        if (!$about instanceof Content && !$about instanceof Poster)
            return '';

        if ($about->viewerIsParent()) {

            $isOwner = true;
        }


        return \App::viewHelper()->partial('base/relation/partial/label-privacy', [
            'about'   => $about,
            'type'    => $type,
            'value'   => $value,
            'icon'    => $icon,
            'isOwner' => $isOwner,
            'label'   => \App::text('core.shared') . ' : ' . \App::relationService()->getPrivacyLabel($about),
        ]);
    }

}