<?php

namespace Kendo\Html;

/**
 * Class CheckboxField
 *
 * @package Kendo\Html
 */
class CheckboxField extends HtmlElement implements FormField
{
    /**
     * @var bool
     */
    protected $checked = false;

    /**
     * @var mixed
     */
    protected $checkedValue = "1";

    /**
     * @var mixed
     */
    protected $uncheckedValue = "0";

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        $this->setAttribute('value', $this->checkedValue);

        return '<div class="checkbox"><label><input ' . $this->_flat($this->attributes) . '/>' . $this->getLabel() . '</label></div>';
    }

    /**
     * @return boolean
     */
    public function isChecked()
    {
        return $this->checked;
    }

    /**
     * @param boolean $checked
     */
    public function setChecked($checked)
    {
        $this->checked = (bool)$checked;

        if ($checked) {
            $this->setAttribute('checked', 'true');
        } else {
            $this->removeAttribute('checked');
        }
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->isChecked() ? $this->checkedValue : $this->uncheckedValue;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->setChecked($value == $this->getCheckedValue());
    }

    /**
     * @return mixed
     */
    public function getCheckedValue()
    {
        return $this->checkedValue;
    }

    /**
     * @param mixed $checkedValue
     */
    public function setCheckedValue($checkedValue)
    {
        $this->checkedValue = $checkedValue;

        if ($checkedValue == $this->getValue()) {
            $this->setChecked(true);
        }
    }

    /**
     * @return mixed
     */
    public function getUncheckedValue()
    {
        return $this->uncheckedValue;
    }

    /**
     * @param mixed $uncheckedValue
     */
    public function setUncheckedValue($uncheckedValue)
    {
        $this->uncheckedValue = $uncheckedValue;
    }

    /**
     * @return false
     */
    public function hasLabel()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function hasNote()
    {
        return false;
    }

    /**
     * Override method
     */
    protected function init()
    {
        $this->attributes['type'] = 'checkbox';
    }
}