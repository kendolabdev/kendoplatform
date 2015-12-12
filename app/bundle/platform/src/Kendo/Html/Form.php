<?php

namespace Kendo\Html;

use Kendo\Model;

/**
 * Class Form
 *
 * @package Kendo\Html
 */
class Form extends HtmlCollection
{
    protected $attributes = ['method' => 'POST'];

    /**
     * @var string
     */
    private $title = '';

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = \App::text($title);
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->setAttribute('method', strtoupper($method));
    }

    /**
     * Available options:
     * application/x-www-form-urlencoded <br/>
     * multipart/form-data <br/>
     * text/plain <br/>
     *
     * @param string $enctype
     */
    public function setEnctype($enctype)
    {
        $this->setAttribute('enctype', $enctype);
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->setAttribute('action', $action);
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        if ($data instanceof Model) {
            $data = $data->toArray();
        }
        $this->setValue($data);
    }


    /**
     * @return array
     */
    public function getData()
    {
        $response = [];

        foreach ($this->byNames as $name => $element) {
            if ($element instanceof FormField && !$element->isDisabled()) {
                $response[ $name ] = $element->getValue();
            }
        }

        return $response;
    }

    /**
     * @param array $options
     *
     * @return string
     */
    public function asSearch($options = [])
    {
        return $this->renderElements('asSearch', $options);
    }

    /**
     * @param array $options
     *
     * @return string
     */
    public function asList($options = [])
    {
        return $this->renderElements('asList', $options);
    }

    /**
     * @param array $options
     *
     * @return string
     */
    public function asAbout($options = [])
    {
        return $this->renderElements('asAbout', $options);
    }

    /**
     * @param string $plugin
     * @param array  $options
     *
     * @return string
     */
    public function renderElements($plugin, $options = [])
    {
        return \App::htmlService()->render($plugin, $this, $options);
    }

    /**
     * @param array $options
     *
     * @return string
     */
    public function asTable($options = [])
    {
        return $this->renderElements('asTable', $options);
    }

    /**
     * @param array $attrs
     *
     * @return string
     */
    public function open($attrs = [])
    {
        if (!empty($attrs)) {
            foreach ($attrs as $key => $value) {
                $this->setAttribute($key, $value);
            }
        }

        return '<form ' . $this->_flat($this->attributes) . '>';
    }

    /**
     * @return string
     */
    public function close()
    {
        return '</form>';
    }

}