<?php
namespace Relation\Service;

use Picaso\Application\EventHandler;
use Picaso\Assets\Requirejs;
use Picaso\Content\HasMember;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
use Picaso\Hook\SimpleContainer;
use Relation\Model\Relation;
use Relation\Model\RelationItem;
use User\Model\User;

/**
 * Class EventHandlerService
 *
 * @package Relation\Service
 */
class EventHandlerService extends EventHandler
{
    /**
     * @param HookEvent $event
     */
    public function onRequirejsRender(HookEvent $event) {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/relation/main'])
            ->addPrimaryBundle('base/relation/main');
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onBeforeBuildBundleJS(HookEvent $event)
    {
        $requirejs = $event->getPayload();

        if (!$requirejs instanceof Requirejs) return;

        $requirejs->addDependency(['base/relation/main']);
    }

    /**
     * @param HookEvent $event
     */
    public function onAfterInsertPoster(HookEvent $event)
    {
        $payload = $event->payload;

        if (!$payload instanceof Poster) {
            return;
        }

        \App::relationService()->buildRelationsForPoster($payload);

        \App::values()->mergeValues($payload, [
            'share_status' => RELATION_TYPE_ANYONE,
        ]);
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
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

        if (!$parent instanceof HasMember) return;

        $parent->modify('member_count', 'member_count+1');

    }

    /**
     * @param \Picaso\Hook\HookEvent $event
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

        if (!$parent instanceof HasMember) return;

        $parent->modify('member_count', 'member_count-1');

    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onAcceptMembershipRequest(HookEvent $event)
    {
        $parent = $event->get('parent');
        $poster = $event->get('poster');

        if (!$parent instanceof Poster or !$poster instanceof Poster) return;

        \App::relationService()->addRelationItem($parent, $poster, RELATION_TYPE_MEMBER);

        /**
         * 2 ways friends for required.
         */
        if ($parent instanceof User && $poster instanceof User) {
            \App::relationService()->addRelationItem($poster, $parent, RELATION_TYPE_MEMBER);
        }
    }

    /**
     * @param \Picaso\Hook\HookEvent $event
     */
    public function onClearMembership(HookEvent $event)
    {
        $parent = $event->get('parent');
        $poster = $event->get('poster');

        if (!$poster instanceof Poster or !$parent instanceof Poster) return;

        \App::relationService()->clearRelationItem($parent, $poster);

        /**
         * 2 ways membership need to required to clear
         */
        if ($poster instanceof User && $parent instanceof User) {
            \App::relationService()->clearRelationItem($poster, $parent);

        }
    }
}