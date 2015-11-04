<?php

namespace Picaso\Cache;

/**
 * Interface CacheInterface
 *
 * @package Picaso\Cache
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
     * @param         string $key
     * @param int            $minutes
     * @param \Closure|null  $closure
     *
     * @return mixed
     */
    public function get($key, $minutes = 0, \Closure $closure = null);

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function forget($key);

    /**
     * Remove all data
     */
    public function flush();
}