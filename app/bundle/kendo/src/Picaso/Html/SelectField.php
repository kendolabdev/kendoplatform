<?php


namespace Picaso\Html;

/**
 * Class SelectField
 *
 * @package Picaso\Html
 */
class SelectField extends HtmlElement implements FormField
{
    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var int|string
     */
    protected $optionTextKey = '';

    /**
     * @var string
     */
    protected $placeholder;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
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

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        if (\App::registry()->get('prefer_dropdown_button')) {
            return $this->toButtonHtml();
        } else {
            return $this->toOptionsHtml();
        }
    }

    /**
     * @return string
     */
    public function toButtonHtml()
    {
        $response = [];

        if (!$this->isRequired()) {
            $response[] = '<li><a role="button">' . $this->placeholder . '</a></li>';
        }

        $bntLabel = $this->getLabel();

        $trans = \App::trans();

        $optionTextKey = $this->getOptionTextKey();

        $selectedLablel = \App::text('core.all');

        foreach ($this->options as $item) {
            $value = $item['value'];
            $label = isset($item['label']) ? $item['label'] : '';

            if ($optionTextKey) {
                if (empty($label) || $label == 1) {
                    $label = $trans->text($optionTextKey . $value);
                } else {
                    $label = $trans->text($optionTextKey . $label);
                }
            }

            $attrs = [
                'value' => $value,
                'label' => $label,
            ];

            if ($value == $this->value) {
                $attrs['selected'] = 'selected';
                $selectedLablel = $label;
            }
            $response[] = '<li role="presentation"><a role="button" ' . $this->_flat($attrs) . '>' . $label . '</a>';
        }

        $bntLabel .= ': ' . $selectedLablel;


        $before = '<div class="dropdown-control"><button data-toggle="dropdown" class="btn btn-sm btn-default">' . $bntLabel . ' <span class="caret"></span></button>';

        return $before . '<ul class="dropdown-menu">' . implode(PHP_EOL, $response) . '</ul></div>';
    }

    /**
     * @return string
     */
    public function toOptionsHtml()
    {
        $response = [];

        if (!$this->isRequired()) {
            $response[] = '<option value="">' . $this->placeholder . '</option>';
        }

        $trans = \App::trans();

        $optionTextKey = $this->getOptionTextKey();

        foreach ($this->options as $item) {
            $value = $item['value'];
            $label = isset($item['label']) ? $item['label'] : '';

            if ($optionTextKey) {
                if (empty($label) || $label == 1) {
                    $label = $trans->text($optionTextKey . $value);
                } else {
                    $label = $trans->text($optionTextKey . $label);
                }
            }

            $attrs = [
                'value' => $value,
                'label' => $label,
            ];

            if ($value == $this->value) {
                $attrs['selected'] = 'selected';
            }
            $response[] = '<option ' . $this->_flat($attrs) . '>' . $label . '</option>';
        }

        return '<select ' . $this->_flat($this->attributes) . '>' . implode(PHP_EOL, $response) . '</select>';
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
        $this->required = $required ? true : false;
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
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * @param string $placeholder
     */
    public function setPlaceholder($placeholder)
    {
        if (null != $placeholder) {
            $this->placeholder = \App::text($placeholder);
        } else {
            $this->placeholder = '';
        }
    }
}