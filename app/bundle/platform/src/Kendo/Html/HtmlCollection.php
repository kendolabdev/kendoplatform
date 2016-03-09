<?php

namespace Kendo\Html;

/**
 * Interface HtmlCollection
 *
 * @package Kendo\Html
 */
class HtmlCollection extends HtmlElement implements FormField
{

    /**
     * @var array
     */
    protected $byNames = [];

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasElement($name)
    {
        return !empty($this->byNames[ $name ]);
    }

    /**
     * @param string $name
     */
    public function removeElement($name)
    {
        unset($this->byNames[ $name ]);
    }

    /**
     * @param array $names
     */
    public function removeElements($names)
    {
        foreach ($names as $name) {
            unset($this->byNames[ $name ]);
        }

    }

    /**
     * @param HtmlElement|array $element
     *
     * @return HtmlCollection
     */
    public function addElement($element)
    {
        if (is_array($element)) {
            $element = app()->html()->create($element);
        }
        $this->byNames[ $element->getName() ] = $element;
    }


    /**
     * @param array $elements
     *
     * @return HtmlCollection
     */
    public function addElements(array $elements)
    {
        $html = app()->html();

        foreach ($elements as $element) {
            if (is_array($element)) {
                $element = $html->create($element);
            }
            $this->byNames[ $element->getName() ] = $element;
        }
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->byNames;
    }

    /**
     * @param array $elements
     */
    public function setElements(array $elements)
    {
        $this->byNames = $elements;
    }

    /**
     * @param string $name
     *
     * @return HtmlElement
     */
    public function getElement($name)
    {
        return isset($this->byNames[ $name ]) ? $this->byNames[ $name ] : false;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        $response = [];

        foreach ($this->byNames as $element) {
            $response[] = $element->toHtml();
        }

        return implode('<br />', $response);
    }

    /**
     * @return array
     */
    public function getValue()
    {
        $response = [];

        foreach ($this->byNames as $name => $element) {
            if ($element instanceof FormField) {
                $response[ $name ] = $element->getValue();
            }
        }

        return $response;
    }

    /**
     * @param array $value
     */
    public function populate($value = [])
    {
        foreach ($value as $key => $val) {

            if (!is_string($key)) continue;

            if (!isset($this->byNames[ $key ]))
                continue;


            $element = $this->byNames[ $key ];


            if (!$element instanceof FormField) {
                continue;
            }

            $element->setValue($val);
        }
    }

    /**
     * @param array $value
     */
    public function setValue($value = [])
    {


        foreach ($value as $key => $val) {

            if (!is_string($key)) continue;

            if (!isset($this->byNames[ $key ]))
                continue;


            $element = $this->byNames[ $key ];


            if (!$element instanceof FormField) {
                continue;
            }

            $element->setValue($val);
        }
    }

    /**
     * @return array
     */
    public function getByNames()
    {
        return $this->byNames;
    }

    /**
     * @param array $byNames
     */
    public function setByNames($byNames)
    {
        $this->byNames = $byNames;
    }

    /**
     * @param $data
     *
     * @return bool
     */
    public function isValid($data)
    {
        $isValid = true;

        foreach ($this->byNames as $name => $element) {

            if (!$element instanceof FormField) {
                continue;
            }

            if (!$element instanceof HtmlElement) {
                continue;
            }

            $result = $element->isValid(isset($data[ $name ]) ? $data[ $name ] : null);

            if (!$result) {
                $this->addErrors($element->getErrors());
                $isValid = false;
            }
        }

        return $isValid;
    }
}