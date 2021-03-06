<?php

namespace Kendo\View;

use Kendo\Layout\BlockParams;

/**
 * Class View
 *
 * @package Kendo\View
 */
class View
{

    /**
     * @var string
     */
    protected $script;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var bool
     */
    protected $noRender = false;

    /**
     * @param string $script
     * @param array  $data
     */
    public function __construct($script = '', $data = [])
    {
        if (!empty($script)) {
            $this->setScript($script);
        }

        if (!empty($data)) {
            $this->setData($data);
        }
    }

    /**
     *
     * @return ViewHelper
     */
    public static function helper()
    {
        return app()->viewHelper();
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return \Kendo\View\View
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param array $vars
     *
     * @return View
     */
    public function assign($vars)
    {
        foreach ($vars as $name => $value) {
            $this->data[ $name ] = $value;
        }

        return $this;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        if ($this->isNoRender()) {
            return '';
        }

        $script = $this->getScript();

        if (empty($script)) {
            return '';
        }

        $script = app()->viewFinder()->findPath($script);


        if (false == $script) {
            throw new \Exception(sprintf('Unexpected view "%s"', $this->getScript()));
        }

        ob_start();

        /**
         * Ensure output buffers must be close
         */
        try {
            extract($this->data, EXTR_SKIP);
            include $script;
        } catch (\Exception $ex) {
            echo ob_get_clean();
            throw $ex;
        }

        return ob_get_clean();
    }

    /**
     * @return boolean
     */
    public function isNoRender()
    {
        return $this->noRender;
    }

    /**
     * @param boolean $noRender
     */
    public function setNoRender($noRender)
    {
        $this->noRender = $noRender;
    }

    /**
     * @return string
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * @param string|BlockParams $script
     *
     * @return View
     */
    public function setScript($script)
    {
        if ($script instanceof BlockParams)
            $script = $script->script();

        $this->script = $script;

        return $this;
    }

    /**
     * Forward this view to other scripts
     *
     * @param string $script
     *
     * @return string
     */
    public function forward($script)
    {
        return $this->setScript($script)->render();
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return isset($this->data[ $name ]) ? $this->data[ $name ] : null;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->data[ $name ] = $value;
    }
}