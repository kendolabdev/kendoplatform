<?php

namespace Kendo\Log;

/**
 * Class FileWriter
 *
 * @package Core\Log
 */
class FileWriter implements WriterInterface
{

    /**
     * @var string
     */
    protected $uid = '';

    /**
     * @var string
     */
    protected $filename;

    /**
     * @param array $params
     */
    public function __construct($params = [])
    {

        $this->uid = uniqid('log');

        if (isset($params['path']) && !empty($params['path'])) {
            $this->filename = realpath($params['path']);
        }

        if (!$this->filename) {
            $this->filename = KENDO_TEMP_DIR . '/log/main.log';
        }

        if (!is_dir($dir = dirname($this->filename)) && !@mkdir($dir, 0777, true))
            throw new \RuntimeException(sprintf('%s is not writable', $this->filename));

    }

    /**
     * @param      $msg
     * @param null $data
     *
     * @return WriterInterface
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
        if (null != ($fp = fopen($this->filename, 'a+'))) {
            fwrite($fp, KENDO_DATE_TIME . ': ' . $level . PHP_EOL . 'UID: ' . $this->uid . PHP_EOL . $msg . PHP_EOL . PHP_EOL);
            fclose($fp);
        }
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
     * @return FileWriter
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
     * @return FileWriter
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
     * @return FileWriter
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
     * @return FileWriter
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
     * @return FileWriter
     */
    public function warn($msg, $data = null)
    {
        $this->write(LOG_LEVEL_WARNING, $this->format($msg, $data));

        return $this;
    }
}