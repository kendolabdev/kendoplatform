<?php

namespace Kendo\Log;

/**
 * Interface WriterInterface
 *
 * @package Kendo\Log
 */
interface WriterInterface
{

    /**
     * @param      $msg
     * @param null $data
     *
     * @return WriterInterface
     */
    public function log($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return WriterInterface
     */
    public function info($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return WriterInterface
     */
    public function notice($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return WriterInterface
     */
    public function debug($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return WriterInterface
     */
    public function crit($msg, $data = null);

    /**
     * @param      $msg
     * @param null $data
     *
     * @return WriterInterface
     */
    public function warn($msg, $data = null);

}