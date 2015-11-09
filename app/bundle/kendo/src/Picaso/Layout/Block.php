<?php

namespace Picaso\Layout;

use Picaso\View\View;


/**
 * Class Block
 *
 * @package Picaso\Layout
 */
class Block
{

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var int
     */
    protected $badge = null;

    /**
     * @var \Picaso\View\View
     */
    protected $view;

    /**
     * @var BlockParams
     */
    protected $lp;

    /**
     * @var bool
     */
    protected $noRender = false;

    /**
     * @param array|string $params
     *
     */
    public function __construct($params = null)
    {
        $this->view = new View();

        if (!empty($params)) {
            $this->lp = new BlockParams($params);
            $this->view->setScript($this->lp->script());
        }
    }

    /**
     * Override this method to execute this block by page manager
     *
     * @return bool
     */
    public function execute()
    {

    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return int
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param int $badge
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
    }

    /**
     * @return View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param View $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->view->render();
    }

    /**
     * @return bool
     */
    public function hasTitle()
    {
        return '' != $this->getTitle();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        if (null == $this->title) {
            $this->title = $this->lp->get('title');
        }
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function render()
    {
        try {
            if ($this->isNoRender()) {
                return '';
            }

            $wrapper = 'none';
            $params = [];

            return \App::layout()->getBlockWrapper($wrapper)->render($this, $params);
        } catch (\RuntimeException $ex) {
            return $ex->getMessage();
        }

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
    public function getCssClassName()
    {
        return '_block ' . strtolower(str_replace(['\\', '.'], ['-', ''], str_replace('\Block', '', get_class($this))));
    }
}