<?php

namespace Core\Log;

use Picaso\Log\LogWriterInterface;

/**
 * Class DbWriter
 *
 * @package Picaso\Log
 */
class DbWriter implements LogWriterInterface
{

    /**
     * @var string
     */
    protected $uid = '';

    /**
     * @var string
     */
    protected $driver = null;

    /**
     * @param $params
     */
    public function __construct($params)
    {

        $this->uid = uniqid('log');

        if (isset($params['connection']) && !empty($params['connection'])) {
            $this->driver = $params['connection'];
        }

        if (isset($params['table']) && !empty($params['table'])) {
            $this->table = $params['table'];
        }
    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return DbWriter
     */
    public function log($msg, $data = null)
    {
        $this->write(Level::LOG, $this->format($msg, $data));

        return $this;
    }

    /**
     * @param $level
     * @param $msg
     */
    protected function write($level, $msg)
    {
        \App::table('core.log')
            ->fetchNew([
                'level'      => $level,
                'uid'        => $this->uid,
                'message'    => $msg,
                'created_at' => PICASO_DATE_TIME,
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
        $this->write(Level::INFO, $this->format($msg, $data));

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
        $this->write(Level::NOTICE, $this->format($msg, $data));

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
        $this->write(Level::DEBUG, $this->format($msg, $data));

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
        $this->write(Level::CRIT, $this->format($msg, $data));

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
        $this->write(Level::WARN, $this->format($msg, $data));

        return $this;
    }
}