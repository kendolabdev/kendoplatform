<?php

namespace Platform\Feed\Service;

use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;
use Platform\Core\Form\PosterPrivacySetting;
use Kendo\Application\EventHandler;
use Kendo\Assets\Requirejs;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Hook\HookEvent;
use Kendo\Hook\SimpleContainer;
use Kendo\View\View;

/**
 * Class EventHandlerService
 *
 * @package Feed\Service
 */
class DispatcherService extends EventHandler
{

    /**
     * @param HookEvent $event
     */
    public function onViewHelperStart(HookEvent $event)
    {
        $helper = $event->getPayload();

        if (!$helper instanceof ViewHelper) return;

        $helper->addClassMaps([
            'decorateStory' => '\Feed\ViewHelper\DecorateStory',
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing = \App::routingService();

        $routing->addRoute('hashtag', [
            'uri'      => 'hashtag',
            'defaults' => [
                'controller' => '\Feed\Controller\HomeController',
                'action'     => 'hashtag',
            ],
        ]);

        $routing->addRoute('feed_view', [
            'uri'      => 'feed/<id>',
            'uri_expr' => [
                'id' => '\d+',
            ],
            'defaults' => [
                'controller' => '\Feed\Controller\HomeController',
                'action'     => 'view-feed',
            ]
        ]);

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'      => 'timeline',
                'controller' => '\Feed\Controller\ProfileController',
                'action'     => 'timeline']));
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleStylesheet(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof SimpleContainer) return;

        $payload->add('platform/feed', 'platform/feed/main');
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/feed/main'])
            ->addPrimaryBundle('platform/feed/main');
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/feed/main']);
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerHeader(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof PosterInterface) return;

        $content = \App::viewHelper()->partial('platform/feed/partial/composer-header-add-status');

        $event->prepend($content);
    }

    /**
     * @param HookEvent $event
     */
    public function onRenderActivityComposerFooter(HookEvent $event)
    {

        $payload = $event->getPayload();

        if (false == \App::authService()->logged()) return;

        if (!$payload instanceof PosterInterface) return;

        if (!\App::aclService()->pass($payload, 'activity__checkin')) return;

        $content = \App::viewHelper()->partial('platform/feed/partial/composer-footer-add-place');

        $event->append($content);
    }

    /**
     * @param $item
     *
     * @return array
     */
    public function onProfileMenuItemTimeline($item)
    {
        $profile = \App::registryService()->get('profile');

        if (!$profile instanceof PosterInterface)
            return false;

        if (!$profile->authorize('activity__timeline_tab_exists'))
            return false;

        if (!\App::aclService()->pass($profile, 'activity__timeline_tab_view'))
            return false;


        $item['href'] = $profile->toHref(['stuff' => 'timeline']);

        return $item;
    }

    /**
     * @param HookEvent $event
     */
    public function onAdminStatisticBlockRender(HookEvent $event)
    {
        $payload = $event->getPayload();

        if (!$payload instanceof View) return;

        $stats = $payload->__get('stats');

        $stats['comment'] = [
            'label' => \App::text('core.comments'),
            'value' => \App::commentService()->getAdminStatisticCount(),
        ];

        $stats['like'] = [
            'label' => \App::text('core.likes'),
            'value' => \App::likeService()->getAdminStatisticCount(),
        ];

        $stats['share'] = [
            'label' => \App::text('core.shares'),
            'value' => \App::shareService()->getAdminStatisticCount(),
        ];

        $stats['feed'] = [
            'label' => \App::text('core.feeds'),
            'value' => \App::feedService()->getAdminStatisticCount(),
        ];

        $payload->__set('stats', $stats);
    }

    /**
     * @param HookEvent $event
     */
    public function onBeforeInitFormPosterPrivacy(HookEvent $event)
    {
        $form = $event->payload;

        if (!$form instanceof PosterPrivacySetting) {
            return;
        }

        $poster = $form->getPoster();

        $forParent = $forPoster = $poster;
        $alignment = 'left';

        if (!$poster instanceof PosterInterface) {
            return;
        }

        $form->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'profile__view',
            'label'     => 'form_privacy_setting.view_profile_label',
            'note'      => 'form_privacy_setting.view_profile_note',
            'forParent' => $forParent,
            'forPoster' => $forPoster,
            'forAction' => 'profile__view',
            'alignment' => $alignment,
            'value'     => \App::value($forParent, 'core__view_profile', RELATION_TYPE_ANYONE),
        ]);

        $form->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'profile__view_timeline',
            'label'     => 'form_privacy_setting.view_timeline',
            'note'      => 'form_privacy_setting.view_timeline_noe',
            'forParent' => $forParent,
            'forPoster' => $forPoster,
            'forAction' => 'profile__view_timeline',
            'alignment' => $alignment,
            'value'     => \App::value($forParent, 'profile__view_timeline', RELATION_TYPE_ANYONE),
        ]);

        $form->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'activity__update_status',
            'label'     => 'form_privacy_setting.post_profile_label',
            'note'      => 'form_privacy_setting.post_profile_note',
            'forParent' => $forParent,
            'forPoster' => $forPoster,
            'forAction' => 'update_status',
            'alignment' => $alignment,
            'value'     => \App::value($forParent, 'activity__update_status', RELATION_TYPE_ANYONE),
        ]);

        $form->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'user__request_friends',
            'label'     => 'form_privacy_setting.friend_request_label',
            'note'      => 'form_privacy_setting.friend_request_note',
            'forParent' => $forParent,
            'forPoster' => $forPoster,
            'forAction' => 'user__request_friends',
            'alignment' => $alignment,
            'accepts'   => [RELATION_TYPE_ANYONE, RELATION_TYPE_MEMBER_OF_MEMBER],
            'value'     => \App::value($forParent, 'user__request_friends', RELATION_TYPE_REGISTERED),
        ]);

        $form->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'activity__follow',
            'label'     => 'form_privacy_setting.follow_profile_label',
            'note'      => 'form_privacy_setting.follow_profile_note',
            'forParent' => $forParent,
            'forPoster' => $forPoster,
            'forAction' => 'activity__follow',
            'alignment' => $alignment,
            'accepts'   => [RELATION_TYPE_ANYONE, RELATION_TYPE_REGISTERED, RELATION_TYPE_MEMBER],
            'value'     => \App::value($forParent, 'activity__follow', RELATION_TYPE_REGISTERED),
        ]);

        $form->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'activity__tag_people',
            'label'     => 'form_privacy_setting.tag_profile_label',
            'note'      => 'form_privacy_setting.tag_profile_note',
            'forParent' => $forParent,
            'forPoster' => $forPoster,
            'forAction' => 'activity__tag_people',
            'alignment' => $alignment,
            'accepts'   => [RELATION_TYPE_ANYONE, RELATION_TYPE_REGISTERED, RELATION_TYPE_MEMBER],
            'value'     => \App::value($forParent, 'activity__tag_people', RELATION_TYPE_REGISTERED),
        ]);

        $form->addElement([
            'plugin'    => 'privacyButton',
            'name'      => 'message__send_message',
            'label'     => 'form_privacy_setting.send_message_label',
            'note'      => 'form_privacy_setting.send_message_note',
            'forParent' => $forParent,
            'forPoster' => $forPoster,
            'forAction' => 'message__send_message',
            'alignment' => $alignment,
            'accepts'   => [RELATION_TYPE_ANYONE, RELATION_TYPE_REGISTERED, RELATION_TYPE_MEMBER],
            'value'     => \App::value($forParent, 'message__send_message', RELATION_TYPE_REGISTERED),
        ]);
    }

    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterInsertContent(HookEvent $event)
    {
        $about = $event->getPayload();

        if (!$about instanceof ContentInterface) return;

    }


    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterDeleteContent(HookEvent $event)
    {
        $about = $event->getPayload();

        if (!$about instanceof ContentInterface) return;


    }


    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterInsertPoster(HookEvent $event)
    {
        /**
         * TODO: before insert poster get notification logic
         */
    }


    /**
     * @param \Kendo\Hook\HookEvent $event
     */
    public function onAfterDeletePoster(HookEvent $event)
    {
        $poster = $event->getPayload();

        if (!$poster instanceof PosterInterface) return;

    }
}