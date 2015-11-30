<?php

namespace Picaso\Html;

/**
 * Class TextareaField
 *
 * @package Picaso\Html
 */
class TextareaField extends HtmlElement implements FormField
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var array
     */
    protected $pluginOptions = [];

    /**
     * @var bool
     */
    protected $htmlEditor = true;

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        if ($this->isHtmlEditor())
        {

            \App::assetService()
                ->requirejs()
                ->addDependency('base/core/html_editor')
                ->addScript('checkEditors', 'checkEditors()');

            $this->attributes['class'] = 'hidden';

            return '<div>'.
                '<textarea data-initialize="html_editor" name="'.$this->getName(). '">' . $this->getValue() . '</textarea>'
                .'</div>';
        }
        else
        {
            return '<textarea ' . $this->_flat($this->attributes) . '>' . $this->getValue() . '</textarea>';
        }
    }

    /**
     * @return boolean
     */
    public function isHtmlEditor()
    {
        return $this->htmlEditor;
    }

    /**
     * @param boolean $htmlEditor
     */
    public function setHtmlEditor($htmlEditor)
    {
        $this->htmlEditor = $htmlEditor;
    }

    /**
     * @return bool
     */
    public function getHtmlEditor()
    {
        return $this->htmlEditor;
    }

    /**
     * @return array
     */
    public function getPluginOptions()
    {
        return $this->pluginOptions;
    }

    /**
     * @param array $pluginOptions
     */
    public function setPluginOptions($pluginOptions)
    {
        $this->pluginOptions = $pluginOptions;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}