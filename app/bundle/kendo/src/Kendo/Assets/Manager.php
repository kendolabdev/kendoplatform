<?php

namespace Kendo\Assets;

/**
 * Class Manager
 *
 * @package Kendo\Assets
 */
class Manager
{

    /**
     * @var Description
     */
    private $description;

    /**
     * @var Title
     */
    private $_title;

    /**
     * @var Meta
     */
    private $_meta;

    /**
     * @var Link
     */
    private $_link;

    /**
     * @var Script
     */
    private $_headScript;

    /**
     * @var Script
     */
    private $_script;

    /**
     * @var JsFile
     */
    private $_js;

    /**
     * @var JsFile
     */
    private $_headJs;

    /**
     * @var Requirejs
     */
    private $_requirejs;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_title = new Title();
        $this->_meta = new Meta();
        $this->_link = new Link();
        $this->description = new Description();
        $this->_headScript = new Script();
        $this->_script = new Script();
        $this->_headJs = new JsFile();
        $this->_js = new JsFile();
        $this->_requirejs = new Requirejs();
    }


    /**
     * @param  array $attributes
     *
     * @return string
     */
    public static function implodeAttributes($attributes)
    {
        $response = [];

        if (!is_array($attributes)) return '';
        foreach ($attributes as $name => $value) {
            $response[] = sprintf('%s="%s"', $name, htmlentities($value));
        }

        return implode(' ', $response);
    }

    /**
     * @return Requirejs
     */
    public function requirejs()
    {
        return $this->_requirejs;
    }

    /**
     * @return Link
     */
    public function link()
    {
        return $this->_link;
    }

    /**
     * @return Script
     */
    public function headScript()
    {
        return $this->_headScript;
    }

    /**
     * @return Script
     */
    public function script()
    {
        return $this->_script;
    }

    /**
     * @return JsFile
     */
    public function js()
    {
        return $this->_js;
    }

    /**
     * @return JsFile
     */
    public function headjs()
    {
        return $this->_headJs;
    }

    /**
     * @return string
     */
    public function header()
    {
        \App::hookService()
            ->notify('onBeforeRenderAssetsHeader', $this);

        $response = [];

        $accepts = [
            $this->_title,
            $this->description,
            $this->_meta,
            $this->_link,
            $this->_headScript,
            $this->_headJs
        ];

        foreach ($accepts as $accept) {
            if (!$accept instanceof Collection) continue;
            $response[] = $accept->render();
        }

        return \App::viewHelper()->partial('/layout/master/site-head', [
            'head' => implode(PHP_EOL, $response),
        ]);
    }

    /**
     * @return string
     */
    public function footer()
    {
        $response = [];

        $accepts = [
            $this->_js,
        ];

        foreach ($accepts as $accept) {

            if (!$accept instanceof Collection)
                continue;

            $response[] = $accept->render();
        }

        return implode(' ', $response);
    }

    /**
     * @param $path
     *
     * @return string
     */
    public function getUrl($path)
    {
        return KENDO_BASE_URL . $path;
    }

    /**
     * Set title tag value
     *
     * @param $title
     *
     * @return Manager
     */
    public function setTitle($title)
    {
        $this->title()->set($title);

        return $this;
    }

    /**
     * @return Title
     */
    public function title()
    {
        return $this->_title;
    }

    /**
     * @param string $name
     * @param array  $attributes
     *
     * @return Manager
     */
    public function addMeta($name, $attributes)
    {
        $this->meta()
            ->add($name, $attributes);

        return $this;
    }

    /**
     * @return Meta
     */
    public function meta()
    {
        return $this->_meta;
    }

    /**
     * @param $description
     *
     * @return Manager
     */
    public function setDescription($description)
    {
        $this->getDescription()
            ->setVars($description);

        return $this;
    }

    /**
     * @return Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function headCode()
    {
        return \App::setting('core', 'head_script');
    }

    /**
     * @return string
     */
    public function bottomCode()
    {
        return \App::setting('core', 'head_script');
    }
}