<?php

namespace Picaso\Hook;

/**
 * Class Manager
 *
 * @package Picaso\Hook
 */
class Manager
{
    /**
     * @var array
     */
    private $events = [];

    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * Default constructor
     */
    public function __construct()
    {
    }

    /**
     * @return boolean
     */
    public function isLoaded()
    {
        return $this->loaded;
    }

    /**
     * @param boolean $loaded
     */
    public function setLoaded($loaded)
    {
        $this->loaded = $loaded;
    }

    /**
     *  Start hook
     */
    public function start()
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

        $callable = $this->events[ $eventName ][0];

        return \App::service($callable)->{$eventName}($payload);
    }

    /**
     * Notify a signal about an action was occurred
     *
     * @param string $eventName
     * @param null   $payload
     *
     * @return HookEvent
     */
    public function notify($eventName, $payload = null)
    {

        $event = new HookEvent($payload);

        if (empty($this->events[ $eventName ]))
            return $event;

        foreach ($this->events[ $eventName ] as $callable) {
            try {
                \App::service($callable)->{$eventName}($event);
            } catch (\Exception $ex) {
                echo $ex->getMessage();
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
        $this->setLoaded(true);

        return \App::cacheService()
            ->get(['picaso', 'hook', 'loadAllEvents'], 0, function () {
                return $this->_loadAllHookEventFromDatabase();
            });
    }


    /**
     * @return array
     */
    public function _loadAllHookEventFromDatabase()
    {
        $result = [];

        $items = \App::table('core.core_hook')
            ->select()
            ->where('module_name IN ?', \App::extensions()->getActiveModuleNames())
            ->order('event_name, load_order', 1)
            ->toAssocs();

        foreach ($items as $item) {
            $result[ $item['event_name'] ][] = $item['service_name'];
        }

        return $result;
    }
}