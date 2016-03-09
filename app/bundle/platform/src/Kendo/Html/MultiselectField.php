<?php


namespace Kendo\Html;

/**
 * Class MultiSelectField
 *
 * @package Kendo\Html
 */
class MultiSelectField extends HtmlElement implements FormField
{
    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var array
     */
    protected $value = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var string|int
     */
    protected $optionTextKey = '';

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

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        return '<select ' . $this->_flat($this->attributes) . '>' . $this->optionsToHtml() . '</select>';
    }

    /**
     * @return string
     */
    public function optionsToHtml()
    {
        $response = [];

        if (!$this->isRequired()) {
            $response[] = '<option value=""></option>';
        }

        $optionTextKey = $this->getOptionTextKey();

        $trans = app()->trans();


        foreach ($this->options as $item) {
            $value = $item['value'];
            $label = isset($item['label']) ? $item['label'] : '';

            if ($optionTextKey) {
                if ($label) {
                    $label = $trans->text($optionTextKey . $label);
                } else {
                    $label = $trans->text($optionTextKey . $value);
                }
            }

            $attrs = [
                'value' => $value,
                'label' => $label,
            ];

            if (in_array($value, $this->value)) {
                $attrs['selected'] = 'selected';
            }
            $response[] = '<option ' . $this->_flat($attrs) . '>' . $label . '</option>';
        }

        return implode(PHP_EOL, $response);
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param boolean $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
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

    protected function init()
    {
        $this->setAttribute('multiple', 'true');
    }


}