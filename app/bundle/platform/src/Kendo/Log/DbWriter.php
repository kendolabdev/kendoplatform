<?php

namespace Kendo\Log;

/**
 * Class DbWriter
 *
 * @package Kendo\Log
 */
class DbWriter implements WriterInterface
{

    /**
     * @var string
     */
    protected $uid = '';

    /**
     * @param $params
     */
    public function __construct($params)
    {

        $this->uid = uniqid('log');
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return DbWriter
     */
    public function log($msg, $data = null)
    {
        $this->write(LOG_LEVEL_LOG, $this->format($msg, $data));

        return $this;
    }

    /**
     * @param $level
     * @param $msg
     */
    protected function write($level, $msg)
    {
        \App::table('platform_core_log')
            ->fetchNew([
                'level'      => $level,
                'uid'        => $this->uid,
                'message'    => $msg,
                'created_at' => KENDO_DATE_TIME,
            ])->save();
    }

    /**
     * @param string $msg
     * @param        $data
     *
     * @return string
     */
    protected function format($msg, $data)
    {
        if (is_null($data)) {
            return $msg;
        } else if (is_array($data)) {
            return strtr($msg, $data);
        } else if (is_scalar($data)) {
            return str_replace('?', (string)$data, $msg);
        } else {
            return $msg;
        }
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return DbWriter
     */
    public function info($msg, $data = null)
    {
        $this->write(LOG_LEVEL_INFO, $this->format($msg, $data));

        return $this;
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return DbWriter
     */
    public function notice($msg, $data = null)
    {
        $this->write(LOG_LEVEL_NOTICE, $this->format($msg, $data));

        return $this;
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return DbWriter
     */
    public function debug($msg, $data = null)
    {
        $this->write(LOG_LEVEL_DEBUG, $this->format($msg, $data));

        return $this;
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return DbWriter
     */
    public function crit($msg, $data = null)
    {
        $this->write(LOG_LEVEL_CRIT, $this->format($msg, $data));

        return $this;
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return DbWriter
     */
    public function warn($msg, $data = null)
    {
        $this->write(LOG_LEVEL_WARNING, $this->format($msg, $data));

        return $this;
    }
}