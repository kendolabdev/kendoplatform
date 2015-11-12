<?php

namespace Picaso\Html;

/**
 * Class Manager
 *
 * @package Picaso\Html
 */
class Manager
{
    /**
     * @var array
     */
    private $renders = [
        'asList'  => '\Picaso\Html\RenderAsList',
        'asTable' => '\Picaso\Html\RenderAsTable',
        'asAbout' => '\Picaso\Html\RenderAsAbout',
        'asSearch'=> '\Picaso\Html\RenderAsSearch',
    ];

    private $plugins = [
        'button'                    => '\Picaso\Html\ButtonField',
        'checkbox'                  => '\Picaso\Html\CheckboxField',
        'email'                     => '\Picaso\Html\EmailField',
        'fieldset'                  => '\Picaso\Html\Fieldset',
        'form'                      => '\Picaso\Html\Form',
        'hidden'                    => '\Picaso\Html\HiddenField',
        'multicheckbox'             => '\Picaso\Html\MultiCheckboxField',
        'radio'                     => '\Picaso\Html\RadioField',
        'multiselect'               => '\Picaso\Html\MultiSelectField',
        'password'                  => '\Picaso\Html\PasswordField',
        'reset'                     => '\Picaso\Html\ResetField',
        'select'                    => '\Picaso\Html\SelectField',
        'static'                    => '\Picaso\Html\StaticField',
        'submit'                    => '\Picaso\Html\SubmitField',
        'textarea'                  => '\Picaso\Html\TextareaField',
        'text'                      => '\Picaso\Html\TextField',
        'file'                      => '\Picaso\Html\FileField',
        'yesno'                     => '\Picaso\Html\YesnoField',
        'gender'                    => '\Picaso\Html\GenderField',
        'date'                      => '\Picaso\Html\DateField',
        'section'                   => '\Picaso\Html\SectionField',
        'editavatar'                => '\Picaso\Html\EditAvatarField',
        'suggest'                   => '\Picaso\Html\SuggestField',
        'recaptcha'                 => '\Picaso\Html\ReCaptchaField',
        // Use captcha type "recaptcha" by default
        'captcha'                   => '\Picaso\Html\ReCaptchaField',
        'selectLayoutMediaRatio'    => '\Picaso\Html\SelectLayoutMediaRatio',
        'selectLayoutGridSpace'     => '\Picaso\Html\SelectLayoutGridSpace',
        'selectLayoutMediaPosition' => '\Picaso\Html\SelectLayoutMediaPosition',
        'selectLayoutMediaBorder'   => '\Picaso\Html\SelectLayoutMediaBorder',
        'selectLayoutGridDesktop'   => '\Picaso\Html\SelectLayoutGridDesktop',
        'selectLayoutGridTablet'    => '\Picaso\Html\SelectLayoutGridTablet',
        'selectLayoutGridMobile'    => '\Picaso\Html\SelectLayoutGridMobile',
        'selectLayoutEndlessLoad'   => '\Picaso\Html\SelectLayoutMediaAutoload',

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
     * @return \Picaso\Html\RenderInterface
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