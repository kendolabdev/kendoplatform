<?php
namespace Relation\Service;

use Picaso\Application\EventHandler;
use Picaso\Content\HasMember;
use Picaso\Content\Poster;
use Picaso\Hook\HookEvent;
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
    public function onAfterInsertPoster(HookEvent $event)
    {
        $payload = $event->payload;

        if (!$payload instanceof Poster) {
            return;
        }

        \App::relation()->buildRelationsForPoster($payload);

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

        \App::relation()->addRelationItem($parent, $poster, RELATION_TYPE_MEMBER);

        /**
         * 2 ways friends for required.
         */
        if ($parent instanceof User && $poster instanceof User) {
            \App::relation()->addRelationItem($poster, $parent, RELATION_TYPE_MEMBER);
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

        \App::relation()->clearRelationItem($parent, $poster);

        /**
         * 2 ways membership need to required to clear
         */
        if ($poster instanceof User && $parent instanceof User) {
            \App::relation()->clearRelationItem($poster, $parent);

        }
    }
}