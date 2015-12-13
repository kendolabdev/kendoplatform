<?php

namespace Kendo\View;

use Kendo\Content\AtomInterface;
use Kendo\I18n\Timeago;

/**
 * Class ViewHelper
 *
 * @package Kendo\View
 */
class ViewHelper
{

    /**
     * @var array
     */
    protected $plugins = [];

    /**
     * @var array
     */
    protected $classMaps = [];

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * View helper start
     */
    public function start()
    {
        \App::emitter()
            ->emit('onViewHelperStart', $this);
    }

    /**
     * @param  array $attributes
     *
     * @return string
     */
    public static function _flat($attributes)
    {
        $response = [];

        foreach ($attributes as $name => $value) {
            $response[] = sprintf('%s="%s"', $name, htmlentities($value));
        }

        return implode(' ', $response);
    }

    /**
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }

    /**
     * @param array $plugins
     */
    public function setPlugins($plugins)
    {
        $this->plugins = $plugins;
    }

    /**
     * @return array
     */
    public function getClassMaps()
    {
        return $this->classMaps;
    }

    /**
     * @param array $classMaps
     */
    public function setClassMaps($classMaps)
    {
        $this->classMaps = $classMaps;
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getPlugin($name)
    {
        if (empty($this->plugins[ $name ])) {
            if (empty($this->classMaps[ $name ])) {
                throw new \InvalidArgumentException("Plugin $name does not supported");
            }

            $class = $this->classMaps[ $name ];
            $this->plugins[ $name ] = new $class();
        }

        return $this->plugins[ $name ];
    }

    /**
     * @param string $name
     * @param mixed  $plugin
     */
    public function addPlugin($name, $plugin)
    {
        $this->plugins[ $name ] = $plugin;
    }

    /**
     * @param string $name
     */
    public function removePlugin($name)
    {
        if (isset($this->plugins[ $name ])) {
            unset($this->plugins[ $name ]);
        }
    }

    /**
     * @param string $name
     * @param string $class
     */
    public function addClassMap($name, $class)
    {
        $this->classMaps[ $name ] = $class;
    }

    /**
     * Add array of class maps
     *
     * @param $arr
     */
    public function addClassMaps($arr)
    {
        foreach ($arr as $name => $class) {
            $this->classMaps[ $name ] = $class;
        }
    }

    /**
     * @param string $label
     * @param array  $attributes
     * @param null   $route
     * @param array  $params
     * @param array  $hash
     *
     * @return string
     */
    public function textLink($label, $attributes = [], $route = null, $params = [], $hash = [])
    {
        if (!empty($label)) {
            $label = \App::text($label);
        }

        if (empty($attributes['title'])) {
            $attributes['title'] = $label;
        }

        if ($route) {
            $attributes['href'] = \App::routingService()->getUrl($route, $params, $hash);
        }

        return '<a ' . $this->_flat($attributes) . '>' . $label . '</a>';

    }


    /**
     * @param string $label
     * @param array  $attributes
     * @param null   $route
     * @param array  $params
     * @param array  $hash
     *
     * @return string
     */
    public function link($label, $attributes = [], $route = null, $params = [], $hash = [])
    {

        if (empty($attributes['title'])) {
            $attributes['title'] = $label;
        }

        if ($route) {
            $attributes['href'] = \App::routingService()->getUrl($route, $params, $hash);

        }

        return '<a ' . $this->_flat($attributes) . '>' . $label . '</a>';

    }

    /**
     * @param string $msgId
     * @param null   $data
     * @param null   $count
     *
     * @return string
     */
    public function text($msgId, $data = null, $count = null)
    {
        return \App::trans()->text($msgId, $data, $count);
    }

    /**
     * @return string
     */
    public static function content()
    {
        return \App::requestService()->getInitiator()->getResponse();
    }

    /**
     * @param $value
     *
     * @return string
     */
    public static function date($value)
    {
        return \App::trans()->toDate($value);
    }

    /**
     * @param $value
     *
     * @return string
     */
    public static function number($value)
    {
        return $value;
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function toJson($data)
    {
        return json_encode($data);
    }

    /**
     * Return global site setting
     *
     * @param string $group
     * @param string $name
     * @param null   $defaultValue
     *
     * @return mixed
     */
    public function setting($group, $name, $defaultValue = null)
    {
        return \App::setting($group, $name, $defaultValue);
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function escapeJson($data)
    {
        return str_replace('"', '&quote;', json_encode($data));
    }

    /**
     * @return \Kendo\Navigation\Manager
     */
    public static function nav()
    {
        return \App::navigationService();
    }

    /**
     * @return \Kendo\Request\Manager
     */
    public function request()
    {
        return \App::requestService();
    }

    /**
     * @return \Kendo\Html\Manager
     */
    public function html()
    {
        return \App::htmlService();
    }

    /**
     * @return \Kendo\Acl\Manager
     */
    public function acl()
    {
        return \App::aclService();
    }

    /**
     * @return \Kendo\Routing\RoutingManager
     */
    public function routing()
    {
        return \App::routingService();
    }

    /**
     * @param  string $url
     *
     * @return void
     */
    public function redirectToUrl($url)
    {
        @header('location: ' . $url);
        exit(0);
    }

    /**
     * @param string $route
     * @param null   $params
     * @param null   $hash
     */
    public function redirect($route, $params = null, $hash = null)
    {
        $url = $this->routing()->getUrl($route, $params, $hash);
        $this->redirectToUrl($url);
    }

    /**
     * @return \Kendo\Layout\Manager
     */
    public function layout()
    {
        return \App::layoutService();
    }

    /**
     * @param string $from
     *
     * @return string
     */
    public function timeago($from)
    {
        return Timeago::translate($from);
    }

    /**
     * @param string $route
     * @param array  $params
     *
     * @return string
     */
    public function url($route, $params = [])
    {
        return \App::routingService()->getUrl($route, $params);
    }

    /**
     * @param string $script
     * @param array  $data
     *
     * @return string
     * @throws \RuntimeException
     */
    public function partial($script, $data = [])
    {
        return (new View($script, $data))->render();
    }

    /**
     * @param AtomInterface $object
     *
     * @return string
     */
    public function getCover(AtomInterface $object)
    {
        return \App::service('photo.cover')->getCover($object);
    }

    /**
     * @param $errors
     *
     * @return string
     */
    public function formErrors($errors)
    {
        if (empty($errors)) {
            return '';
        }

        $array = [];

        foreach ($errors as $error) {
            $array[] = '<li>' . $error . '</li>';
        }

        return '<ul class="list-unstyled form-errors">' . implode('', $array) . '</ul>';
    }

    /**
     * @return bool
     */
    public function isMobile()
    {
        return \App::requestService()->isMobile();
    }

    /**
     * @return bool
     */
    public function isTablet()
    {
        return \App::requestService()->isTablet();
    }

    /**
     * @return \Kendo\Auth\Manager
     */
    public function auth()
    {
        return \App::authService();
    }

    /**
     * @return bool
     */
    public function logged()
    {
        return $this->auth()->logged();
    }


    /**
     * @return bool
     */
    public function isUser()
    {
        return $this->auth()->isUser();
    }

    /**
     * @param \Kendo\Content\PosterInterface|\Kendo\Content\ContentInterface $item
     *
     * @return string
     */
    public function toLink($item)
    {
        if (!$item)
            return '';

        return '<a href="' . $item->toHref() . '">' . $item->getTitle() . '</a>';

    }

    /**
     * is triggered when invoking inaccessible methods in an object context.
     *
     * @param $name      string
     * @param $arguments array
     *
     * @return mixed
     */
    function __call($name, $arguments)
    {
        return call_user_func_array($this->getPlugin($name), $arguments);
    }
}