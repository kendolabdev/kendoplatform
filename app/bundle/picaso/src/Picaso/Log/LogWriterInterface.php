<?php

namespace Picaso\Log;

/**
 * Interface LogWriterInterface
 *
 * @package Picaso\Log
 */
interface LogWriterInterface
{

    /**
     * @param      $msg
     * @param null $data
     *
     * @return LogWriterInterface
     */
    public function log($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return LogWriterInterface
     */
    public function info($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return LogWriterInterface
     */
    public function notice($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return LogWriterInterface
     */
    public function debug($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return LogWriterInterface
     */
    public function crit($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return LogWriterInterface
     */
    public function warn($msg, $data = null);

}