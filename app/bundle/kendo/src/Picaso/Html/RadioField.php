<?php

namespace Picaso\Html;

/**
 * Class RadioField
 *
 * @package Picaso\Html
 */
class RadioField extends HtmlElement implements FormField
{
    /**
     * @var bool
     */
    protected $inline = false;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var string|int
     */
    protected $optionTextKey = '';

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        return $this->optionsToHtml();
    }

    /**
     * @return string
     */
    public function optionsToHtml()
    {
        $response = [];

        $optionName = $this->getName();

        $trans = \App::trans();

        $optionTextKey = $this->getOptionTextKey();

        foreach ($this->options as $item) {
            $value = isset($item['value']) ? $item['value'] : null;
            $label = isset($item['label']) ? $item['label'] : '';

            if ($optionTextKey) {
                if ($optionTextKey != 1) {
                    if (empty($label) || $label == 1) {
                        $label = $trans->text($optionTextKey . $value);
                    } else {
                        $label = $trans->text($optionTextKey . $label);
                    }
                } else {
                    $label = $trans->text($label);
                }
            }

            $attrs = [
                'type'    => 'radio',
                'name'    => $optionName,
                'value'   => $value,
                'checked' => 'true',
            ];

            if ($value != $this->value) {
                unset($attrs['checked']);
            }

            if ($this->isInline()) {
                $response[] = '<label class="radio-inline"><input ' . $this->_flat($attrs) . '/>' . $label . '</label>';
            } else {
                $response[] = '<div class="radio"><label><input ' . $this->_flat($attrs) . '/>' . $label . '</label></div>';
            }

        }

        return implode(PHP_EOL, $response);
    }

    /**
     * @return int|string
     */
    public function getOptionTextKey()
    {
        return $this->optionTextKey;
    }

    /**
     * @param int|string $optionTextKey
     */
    public function setOptionTextKey($optionTextKey)
    {
        $this->optionTextKey = $optionTextKey;
    }

    /**
     * @return boolean
     */
    public function isInline()
    {
        return $this->inline;
    }

    /**
     * @param boolean $inline
     */
    public function setInline($inline)
    {
        $this->inline = $inline;
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

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
}