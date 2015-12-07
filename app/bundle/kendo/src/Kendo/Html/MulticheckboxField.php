<?php

namespace Kendo\Html;

/**
 * Class MultiCheckboxField
 *
 * @package Kendo\Html
 */
class MultiCheckboxField extends HtmlElement implements FormField
{
    /**
     * @var bool
     */
    protected $inline = false;

    /**
     * @var array
     */
    protected $value = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var mixed
     */
    protected $optionTextKey = '';

    /**
     * Override method
     *
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
            $value = $item['value'];
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
                'type'    => 'checkbox',
                'name'    => $optionName . '[]',
                'value'   => (string)$value,
                'checked' => 'checked',
            ];

            if (!in_array($value, $this->value)) {
                unset($attrs['checked']);
            }

            if ($this->isInline()) {
                $response[] = '<label class="checkbox-inline"><input ' . $this->_flat($attrs) . '/>' . $label . '</label>';
            } else {
                $response[] = '<div class="checkbox"><label><input ' . $this->_flat($attrs) . '/>' . $label . '</label></div>';
            }

        }

        return implode(PHP_EOL, $response);
    }

    /**
     * @return mixed
     */
    public function getOptionTextKey()
    {
        return $this->optionTextKey;
    }

    /**
     * @param mixed $optionTextKey
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
     * @return array
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param array $value
     */
    public function setValue($value)
    {

        if (!is_array($value)) {
            $value = [$value];
        }
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