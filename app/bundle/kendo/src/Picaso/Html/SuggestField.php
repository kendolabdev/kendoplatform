<?php

namespace Picaso\Html;

/**
 * Class SuggestField
 *
 * @package Picaso\Html
 */
class SuggestField extends HtmlElement implements FormField
{
    /**
     * Data toggle to bind javascript event
     */
    const DATA_TOGGLE = 'select';

    /**
     * @var array
     */
    protected $value;

    /**
     * @var bool
     */
    protected $multiple = false;

    /**
     * @var string
     */
    protected $context = 'friend';

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param string $context
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $values = $this->getValue();

        $this->beforeRender();


        $tokens = [];

        if (!empty($values)) {
            foreach ($values as $value) {
                list($id, $type) = explode('@', $value);
                $item = \App::find($type, $id);

                if (null != $item) {
                    $tokens[] = $item;
                }
            }
        }

        return \App::viewHelper()->partial('/layout/form/suggest-field', [
            'attrs'    => $this->_flat($this->attributes),
            'name'     => $this->getName(),
            'multiple' => $this->isMultiple(),
            'tokens'   => $tokens,
        ]);
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function beforeRender()
    {

        $this->setAttribute('data-toggle', self::DATA_TOGGLE);
        $this->setAttribute('data-name', $this->name);
        $this->setAttribute('autocomplete', 'off');
        $this->setAttribute('data-context', $this->context);
        if ($this->multiple) {
            $this->setAttribute('data-multiple', 'true');
        } else {
            $this->setAttribute('data-multiple', 'false');
        }

    }

    /**
     * @return boolean
     */
    public function isMultiple()
    {
        return $this->multiple;
    }

    /**
     * @param boolean $multiple
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;

    }
}