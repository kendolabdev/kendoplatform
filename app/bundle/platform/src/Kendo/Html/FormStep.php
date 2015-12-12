<?php

namespace Kendo\Html;

/**
 * Class FormStep
 *
 * @package Kendo\Html
 */
class FormStep extends Form
{
    /**
     * @var int
     */
    protected $stepNumber = 0;

    /**
     * @var string
     */
    protected $contentType = null;

    /**
     * @var string
     */
    protected $actionType = null;

    /**
     * @return int
     */
    public function getStepNumber()
    {
        return $this->stepNumber;
    }

    /**
     * @param int $stepNumber
     */
    public function setStepNumber($stepNumber)
    {
        $this->stepNumber = $stepNumber;
    }

    /**
     *
     */
    public function saveTemp()
    {
        $data = $this->getData();
        $tempData = $this->loadTempData();
        $key = $this->getProcessId();

        $_SESSION[ $key ] = array_merge($tempData, $data);
    }

    /**
     * Load current saved temporary data
     */
    protected function loadTempData()
    {
        $key = $this->getProcessId();

        if (!empty($_SESSION[ $key ])) {
            return (array)$_SESSION[ $key ];
        }

        return [];
    }

    /**
     * @return string
     */
    public function getProcessId()
    {
        return $this->getContentType() . '_' . $this->getActionType();
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return string
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * @param string $actionType
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;
    }

    /**
     *
     */
    public function load()
    {
        $data = $this->loadTempData();

        $this->setData($data);
    }
}