<?php

namespace Kendo\Html;

/**
 * Interface HtmlElement
 *
 * @package Kendo\Html
 */
class HtmlElement
{
    /**
     * @var int
     */
    protected $fieldId = 0;

    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var bool
     */
    protected $readonly = false;

    /**
     * @var bool
     */
    protected $disabled = false;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $note;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var bool
     */
    protected $hidden;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @return int
     */
    public function getFieldId()
    {
        return $this->fieldId;
    }

    /**
     * @param int $fieldId
     */
    public function setFieldId($fieldId)
    {
        $this->fieldId = $fieldId;
    }

    /**
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->setParams($params);
        $this->init();
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        // prevent loop
        if (isset($params['params'])) {
            unset($params['params']);
        }

        foreach ($params as $name => $value) {

            $method = 'set' . ucfirst($name);

            if (method_exists($this, $method)) {
                $this->{$method}($value);
            } else {
                $this->setAttribute($name, $value);
            }
        }
    }

    /**
     * @param string $name
     * @param string $attribute
     */
    public function setAttribute($name, $attribute)
    {
        $this->attributes[ $name ] = $attribute;
    }

    /**
     * Callback at ended constructor.
     */
    protected function init()
    {

    }

    /**
     * @param  array $attributes
     *
     * @return string
     */
    public static function _flat($attributes)
    {
        $response = [];
        foreach ($attributes as $name => $value) {
            if (is_string($value)) {
                $response[] = sprintf('%s="%s"', $name, htmlentities((string)$value));
            }
        }

        return implode(' ', $response);
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return boolean
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     * @param boolean $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * @param  string $name
     * @param  mixed  $defaultValue
     *
     * @return mixed
     */
    public function getAttribute($name, $defaultValue = null)
    {
        return isset($this->attributes[ $name ]) ? $this->attributes[ $name ] : $defaultValue;
    }

    /**
     * Clear all attribute
     */
    public function clearAttribute()
    {
        $this->attributes[] = [];
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = \App::text($label);
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = \App::text($note);
    }

    /**
     * @return bool
     */
    public function hasNote()
    {
        return !empty($this->note);
    }

    /**
     * @return bool
     */
    public function hasLabel()
    {
        return !empty($this->label);
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
        $this->required = (bool)$required;

        if ($required) {
            $this->setAttribute('required', 'true');
        } else {
            $this->removeAttribute('required');
        }
    }

    /**
     * @param $name
     */
    public function removeAttribute($name)
    {
        unset($this->attributes[ $name ]);
    }

    /**
     * @return boolean
     */
    public function isReadonly()
    {
        return $this->readonly;
    }

    /**
     * @param boolean $readonly
     */
    public function setReadonly($readonly)
    {
        $this->readonly = $readonly;

        if ($readonly) {
            $this->setAttribute('readonly', 'true');
        } else {
            $this->removeAttribute('readonly');
        }
    }

    /**
     * @return boolean
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param boolean $disabled
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        if ($disabled) {
            $this->setAttribute('disabled', 'disabled');
        } else {
            $this->removeAttribute('disabled');
        }
    }

    /**
     * @param string $placeholder
     */
    public function setPlaceholder($placeholder)
    {
        $this->setAttribute('placeholder', \App::text($placeholder));
    }

    /**
     * @param string $tooltip
     */
    public function setTooltip($tooltip)
    {
        $this->setAttribute('tooltip', \App::text($tooltip));
    }

    /**
     * process to html
     *
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        return '';
    }

    /**
     * Override method
     */
    public function beforeRender()
    {
        if(empty($this->attributes['class'])){
            $this->attributes['class'] = 'form-control';
        }

        $this->sanitizeNameAndId();
    }

    public function sanitizeNameAndId()
    {
        $name = $this->getName();
        $this->setAttribute('name', $name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param array $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param array $rules
     */
    public function addRules($rules)
    {
        $this->rules = array_merge($this->rules, $rules);
    }

    /**
     * @param string $rule
     * @param array  $params
     *
     */
    public function addRule($rule, $params)
    {
        $this->rules[ $rule ] = $params;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @param $errors
     */
    public function addErrors($errors)
    {
        if (empty($errors)) {

        } else
            if (is_string($errors)) {
                $this->errors[] = $errors;
            } else {
                foreach ($errors as $error) {
                    $this->errors[] = $error;
                }
            }
    }

    /**
     * @param $value
     *
     * @return true
     */
    public function isValid($value)
    {
        if (!$this instanceof FormField) {
            return true;
        }

        $this->setValue($value);

        if (empty($this->rules)) {
            return true;
        }

        $rule = \App::validationService()->factory($this->rules);

        $isValid = $rule->isValid($value);

        if (!$isValid) {
            $this->addErrors($rule->getMessage());
        }

        return $isValid;
    }

    /**
     * @return string
     */
    public function toFormatValue()
    {
        if (method_exists($this, 'getValue'))
            return $this->getValue();

        return '';
    }

    /**
     * @return bool
     */
    public function hasFormatValue()
    {
        return method_exists($this, 'getValue') && null != $this->getValue();
    }
}