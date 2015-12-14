<?php

namespace Kendo\Html;
use Kendo\Kernel\KernelServiceAgreement;

/**
 * Class Manager
 *
 * @package Kendo\Html
 */
class Manager extends KernelServiceAgreement
{
    /**
     * @var array
     */
    private $decorators = [
        'asList'   => '\Kendo\Html\RenderAsList',
        'asTable'  => '\Kendo\Html\RenderAsTable',
        'asAbout'  => '\Kendo\Html\RenderAsAbout',
        'asSearch' => '\Kendo\Html\RenderAsSearch',
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

        // modules
        'privacyButton'             => '\Platform\Relation\Html\PrivacyButtonField'

    ];

    /**
     * @param       $class
     * @param array $attributes
     *
     * @return Form
     */
    public function factory($class, $attributes = [])
    {
        return new $class($attributes);
    }

    /**
     * @return array
     */
    public function getDecorators()
    {
        return $this->decorators;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param array $decorators
     */
    public function setDecorators($decorators)
    {
        $this->decorators = $decorators;
    }

    /**
     * @param string $name
     * @param string $class
     */
    public function addRender($name, $class)
    {
        $this->decorators[ $name ] = $class;
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
        if (!isset($this->decorators[ $name ])) {
            throw new \InvalidArgumentException("Plugin '$name' does not exists!");
        }

        $class = $this->decorators[ $name ];

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
     * @codeCoverageIgnore
     *
     * @param array $plugins
     */
    public function setPlugins($plugins)
    {
        $this->plugins = $plugins;
    }

    /**
     * @codeCoverageIgnore
     *
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

        $pluginName = $options['plugin'];

        $pluginClassName = $pluginName;

        if (!empty($this->plugins[ $pluginName ])) {
            $pluginClassName = $this->plugins[ $pluginName ];
        }

        if (!class_exists($pluginClassName)) {
            throw new \InvalidArgumentException(sprintf('Unexpected html plugin "%s"', $pluginName));
        }

        unset($options['plugin']);

        return new $pluginClassName($options);
    }
}