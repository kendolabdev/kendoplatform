<?php

namespace Kendo\Cache;

/**
 * Interface CacheInterface
 *
 * @package Kendo\Cache
 */
interface CacheInterface
{

    /**
     * @param      $key
     * @param      $data
     * @param null $minutes
     *
     * @return mixed
     */
    public function set($key, $data, $minutes = null);

    /**
     * To retrieve cache item
     * <code>
     *
     * Remember entry name "var", invalidate item if it is stored when 10 minutes
     * A fallback clousure option is retry of fetch cache item if its invalidate.
     *
     * $cache->get('var', 10, function(){return ...})
     *
     * </code>
     * @param         string $key
     * @param int            $minutes
     * @param \Closure|null  $fallback
     *
     * @return mixed
     */
    public function get($key, $minutes = 0, \Closure $fallback = null);

    /**
     * Delete cache item
     * <code>
     * $cache->forget()
     * </code>
     * @param string $key
     *
     * @return mixed
     */
    public function forget($key);

    /**
     * <code>
     *  $cache->flush()
     * </code>
     * Remove all data
     */
    public function flush();
}