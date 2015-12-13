<?php
namespace Platform\Relation\Service;

use Kendo\Event\EventListener;
use Kendo\Assets\Requirejs;
use Kendo\Content\AtomInterface;
use Kendo\Content\PosterInterface;
use Kendo\Event\HookEvent;
use Kendo\Routing\FilterStuff;
use Kendo\Routing\RoutingManager;
use Kendo\View\ViewHelper;
use Platform\Relation\Model\Relation;
use Platform\Relation\Model\RelationItem;
use Platform\User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Platform\Relation\Service
 */
class EventListenerService extends EventListener
{
    /**
     * @param HookEvent $event
     */
    public function onViewHelperStart(HookEvent $event)
    {
        $helper = $event->getPayload();

        if (!$helper instanceof ViewHelper) return;

        $helper->addClassMaps([
            'labelPrivacy' => '\Relation\ViewHelper\LabelPrivacy'
        ]);
    }

    /**
     * @param HookEvent $event
     */
    public function onRoutingStart(HookEvent $event)
    {
        $routing = $event->getPayload();

        if (!$routing instanceof RoutingManager) return;

        $routing->getRoute('profile')
            ->addFilter(new FilterStuff([
                'stuff'  => 'members',
                'action' => 'browse-member',]));
    }

    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/relation/main'])
            ->addPrimaryBundle('platform/relation/main');
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['platform/relation/main']);
    }

    /**
     * @param HookEvent $event
     */
    public function onAfterInsertPoster(HookEvent $event)
    {
        $payload = $event->payload;

        if (!$payload instanceof PosterInterface) {
            return;
        }

        \App::relationService()->buildRelationsForPoster($payload);

        \App::values()->mergeValues($payload, [
            'share_status' => RELATION_TYPE_ANYONE,
        ]);
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onAfterInsertRelationItem(HookEvent $event)
    {
        $item = $event->getPayload();

        if (!$item instanceof RelationItem) return;

        $relation = $item->getRelation();

        /**
         * validate relation
         */
        if (!$relation instanceof Relation) return;

        /**
         * Check relation type
         */

        if (!$relation->getRelationType() != RELATION_TYPE_MEMBER) return;

        $parent = $relation->getParent();

        if (!$parent instanceof AtomInterface) return;

        $parent->modify('member_count', 'member_count+1');

    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onAfterDeleteRelationItem(HookEvent $event)
    {
        $item = $event->getPayload();

        if (!$item instanceof RelationItem) return;

        $relation = $item->getRelation();

        /**
         * validate relation
         */
        if (!$relation instanceof Relation) return;

        /**
         * Check relation type
         */

        if (!$relation->getRelationType() != RELATION_TYPE_MEMBER) return;

        $parent = $relation->getParent();

        if (!$parent instanceof AtomInterface) return;

        $parent->modify('member_count', 'member_count-1');

    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onAcceptMembershipRequest(HookEvent $event)
    {
        $parent = $event->getPayload('parent');
        $poster = $event->getPayload('poster');

        if (!$parent instanceof PosterInterface or !$poster instanceof PosterInterface) return;

        \App::relationService()->addRelationItem($parent, $poster, RELATION_TYPE_MEMBER);

        /**
         * 2 ways friends for required.
         */
        if ($parent instanceof User && $poster instanceof User) {
            \App::relationService()->addRelationItem($poster, $parent, RELATION_TYPE_MEMBER);
        }
    }

    /**
     * @param \Kendo\Event\HookEvent $event
     */
    public function onClearMembership(HookEvent $event)
    {
        $parent = $event->getPayload('parent');
        $poster = $event->getPayload('poster');

        if (!$poster instanceof PosterInterface or !$parent instanceof PosterInterface) return;

        \App::relationService()->clearRelationItem($parent, $poster);

        /**
         * 2 ways membership need to required to clear
         */
        if ($poster instanceof User && $parent instanceof User) {
            \App::relationService()->clearRelationItem($poster, $parent);

        }
    }
}