<?php
namespace Kendo\Html;

class StaticField extends HtmlElement implements FormField
{

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

        $value = $this->getValue();
        $name = $this->getName();

        if (is_array($value)) {
            $value = implode(', ', $value);
        }

        return '<input type="hidden" name="' . $name . '" value="' . $value . '">' .
        ' <p class="form-control-static">' . $value . '</p>';
    }

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
}