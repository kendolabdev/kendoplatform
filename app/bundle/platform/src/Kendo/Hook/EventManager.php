<?php

namespace Kendo\Hook;

use Kendo\Kernel\KernelServiceAgreement;


/**
 * Class EventEmitter
 *
 * @package Kendo\Hook
 */
class EventManager extends KernelServiceAgreement
{
    /**
     * @var array
     */
    private $events = [];

    /**
     *  Start hook
     *
     * @predecated
     */
    public function bound()
    {
        $this->events = $this->loadAllHookEvents();
    }

    /**
     * @param  string $eventName
     * @param  mixed  $payload
     *
     * @return mixed
     */
    public function callback($eventName, $payload)
    {
        if (empty($this->events[ $eventName ]))
            return null;

        return \App::instance()->make($this->events[ $eventName ][0])->{$eventName}($payload);
    }

    /**
     * Notify a signal about an action was occurred
     *
     * @param string $eventName
     * @param null   $payload
     *
     * @return HookEvent
     * @throws \Exception
     */
    public function emit($eventName, $payload = null)
    {

        $event = new HookEvent($payload);

        if (empty($this->events[ $eventName ]))
            return $event;


        foreach ($this->events[ $eventName ] as $listener) {
            try {
                $instance = \App::instance()
                    ->make($listener);

                if (!$instance instanceof EventListener)
                    continue;

                $instance->{$eventName}($event);

            } catch (\Exception $ex) {
                throw $ex;
            }
        }

        return $event;
    }


    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param array $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * @param string $eventName
     * @param mixed  $callable
     *
     * @return void
     */
    public function addEvent($eventName, $callable)
    {
        $this->events[ $eventName ][] = $callable;
    }

    /**
     * @param       $events
     * @param mixed $handler
     */
    public function addEvents($events, $handler)
    {
        foreach ($events as $eventName) {
            $this->events[ $eventName ][] = [$handler, $eventName];
        }
    }

    /**
     * @param mixed $handler
     */
    public function registerHandler($handler)
    {
        foreach (get_class_methods(get_class($handler)) as $method) {
            if (substr($method, 0, 1) == '_') {
                continue;
            }
            $this->events[ $method ][] = [$handler, $method];
        }
    }

    /**
     * @return array
     */
    public function loadAllHookEvents()
    {
        return \App::cacheService()
            ->get(['Kendo', 'hook', 'loadAllEvents'], 0, function () {
                return $this->loadAllHookEventFromRepository();
            });
    }


    /**
     * @return array
     */
    public function loadAllHookEventFromRepository()
    {
        $result = [];

        $items = $this->app->table('platform_core_hook')
            ->select()
            ->where('module_name IN ?', \App::packages()->getActiveModules())
            ->order('event_name, load_order', 1)
            ->toAssocs();

        foreach ($items as $item) {
            $result[ $item['event_name'] ][] = $item['service_name'];
        }

        return $result;
    }
}