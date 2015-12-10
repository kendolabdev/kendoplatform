<?php
namespace Platform\Core\Session;

/**
 * Class FileSaveHandler
 *
 * @package Core\Session
 */
class FileSaveHandler implements \SessionHandlerInterface
{

    private $savePath;

    /**
     * @param string $savePath
     * @param string $sessionName
     *
     * @return bool
     */
    public function open($savePath, $sessionName)
    {
        if (!$savePath) {
            $savePath = KENDO_TEMP_DIR . '/session';
        }
        $this->savePath = $savePath;
        if (!is_dir($this->savePath)) {
            if (!@mkdir($this->savePath, 0777)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return true
     */
    public function close()
    {
        return true;
    }

    /**
     * @param string $id
     *
     * @return string
     */
    public function read($id)
    {
        if (file_exists($file = "$this->savePath/sess_{$id}")) {
            return (string)@file_get_contents($file);
        }

        return '';
    }

    /**
     * @param string $id
     * @param string $data
     *
     * @return bool
     */
    public function write($id, $data)
    {
        return file_put_contents("$this->savePath/sess_{$id}", $data) === false ? false : true;
    }

    /**
     * @param string $id session id
     *
     * @return true
     */
    public function destroy($id)
    {
        $file = "$this->savePath/sess_$id";
        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }

    /**
     * @param  int $maxlifetime
     *
     * @return true
     */
    public function gc($maxlifetime)
    {
        foreach (glob("$this->savePath/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
            }
        }

        return true;
    }
}