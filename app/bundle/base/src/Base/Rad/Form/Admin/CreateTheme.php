<?php
namespace Base\Rad\Form\Admin;

use Kendo\Html\Form;

/**
 * Create new theme
 *
 * Class CreateTheme
 *
 * @package Rad\Form\Admin
 */
class CreateTheme extends Form
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Create New Theme');
        $this->setNote('Start develope new theme by adding these information');

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'theme_id',
            'class'  => 'form-control',
            'label'  => 'Name',
            'note'   => 'Lower case unique string, examples: default, smarty, uniform-light, ...'
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'name',
            'class'  => 'form-control',
            'label'  => 'Title',
            'note'   => 'examples: Default, Smarty, Uniform - Light',
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'version',
            'class'  => 'form-control',
            'label'  => 'Version',
            'value'  => '1.0.0',
        ]);

        $templateOptions = \App::layoutService()->getTemplateOptions();
        $themeOptions = \App::layoutService()->getThemeOptions();

        $this->addElement([
            'plugin'   => 'radio',
            'name'     => 'parent_theme_id',
            'class'    => 'form-control',
            'required' => true,
            'label'    => 'Base Theme',
            'value'    => 'default',
            'options'  => $themeOptions,
        ]);

        $this->addElement([
            'plugin'   => 'radio',
            'name'     => 'template_id',
            'class'    => 'form-control',
            'required' => true,
            'label'    => 'Base Template',
            'value'    => 'default',
            'options'  => $templateOptions,
        ]);


    }
}