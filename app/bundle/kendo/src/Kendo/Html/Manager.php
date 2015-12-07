<?php

namespace Kendo\Html;

/**
 * Class Manager
 *
 * @package Kendo\Html
 */
class Manager
{
    /**
     * @var array
     */
    private $renders = [
        'asList'  => '\Kendo\Html\RenderAsList',
        'asTable' => '\Kendo\Html\RenderAsTable',
        'asAbout' => '\Kendo\Html\RenderAsAbout',
        'asSearch'=> '\Kendo\Html\RenderAsSearch',
    ];

    private $plugins = [
        'button'                    => '\Kendo\Html\ButtonField',
        'checkbox'                  => '\Kendo\Html\CheckboxField',
        'email'                     => '\Kendo\Html\EmailField',
        'fieldset'                  => '\Kendo\Html\Fieldset',
        'form'                      => '\Kendo\Html\Form',
        'hidden'                    => '\Kendo\Html\HiddenField',
        'multicheckbox'             => '\Kendo\Html\MultiCheckboxField',
        'radio'                     => '\Kendo\Html\RadioField',
        'multiselect'               => '\Kendo\Html\MultiSelectField',
        'password'                  => '\Kendo\Html\PasswordField',
        'reset'                     => '\Kendo\Html\ResetField',
        'select'                    => '\Kendo\Html\SelectField',
        'static'                    => '\Kendo\Html\StaticField',
        'submit'                    => '\Kendo\Html\SubmitField',
        'textarea'                  => '\Kendo\Html\TextareaField',
        'text'                      => '\Kendo\Html\TextField',
        'file'                      => '\Kendo\Html\FileField',
        'yesno'                     => '\Kendo\Html\YesnoField',
        'gender'                    => '\Kendo\Html\GenderField',
        'date'                      => '\Kendo\Html\DateField',
        'section'                   => '\Kendo\Html\SectionField',
        'editavatar'                => '\Kendo\Html\EditAvatarField',
        'suggest'                   => '\Kendo\Html\SuggestField',
        'recaptcha'                 => '\Kendo\Html\ReCaptchaField',
        // Use captcha type "recaptcha" by default
        'captcha'                   => '\Kendo\Html\ReCaptchaField',
        'selectLayoutMediaRatio'    => '\Kendo\Html\SelectLayoutMediaRatio',
        'selectLayoutGridSpace'     => '\Kendo\Html\SelectLayoutGridSpace',
        'selectLayoutMediaPosition' => '\Kendo\Html\SelectLayoutMediaPosition',
        'selectLayoutMediaBorder'   => '\Kendo\Html\SelectLayoutMediaBorder',
        'selectLayoutGridDesktop'   => '\Kendo\Html\SelectLayoutGridDesktop',
        'selectLayoutGridTablet'    => '\Kendo\Html\SelectLayoutGridTablet',
        'selectLayoutGridMobile'    => '\Kendo\Html\SelectLayoutGridMobile',
        'selectLayoutEndlessLoad'   => '\Kendo\Html\SelectLayoutMediaAutoload',

    ];

    /**
     * @param       $class
     * @param array $attributes
     *
     * @return Form
     */
    public function factory($class, $attributes = [])
    {
        $form = new $class($attributes);

        return $form;
    }

    /**
     * @return array
     */
    public function getRenders()
    {
        return $this->renders;
    }

    /**
     * @param array $renders
     */
    public function setRenders($renders)
    {
        $this->renders = $renders;
    }

    /**
     * @param string $name
     * @param string $class
     */
    public function addRender($name, $class)
    {
        $this->renders[ $name ] = $class;
    }

    /**
     * @param             $plugin
     * @param HtmlElement $element
     * @param array       $options
     *
     * @return string
     */
    public function render($plugin, HtmlElement $element, $options = [])
    {
        return $this->getRender($plugin)->render($element, $options);
    }

    /**
     * @param $name
     *
     * @return \Kendo\Html\RenderInterface
     */
    public function getRender($name)
    {
        if (!isset($this->renders[ $name ])) {
            throw new \InvalidArgumentException("Plugin '$name' does not exists!");
        }

        $class = $this->renders[ $name ];

        return new $class;
    }

    /**
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }

    /**
     * @param array $plugins
     */
    public function setPlugins($plugins)
    {
        $this->plugins = $plugins;
    }

    /**
     * @param string $name
     * @param string $class
     *
     * @return Manager
     */
    public function addPlugin($name, $class)
    {
        $this->plugins[ $name ] = $class;

        return $this;
    }

    /**
     * @param  array $options
     *
     * @return HtmlElement
     */
    public function create($options)
    {
        if (empty($options['plugin'])) {
            $options['plugin'] = 'text';
        }

        $class = $this->plugins[ $options['plugin'] ];

        return new $class($options);
    }
}