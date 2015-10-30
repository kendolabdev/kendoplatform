<?php

namespace Phrase\Form\Admin;

use Picaso\Html\Form;

/**
 * Class FilterPhrase
 *
 * @package Phrase\Form\Admin
 */
class FilterPhrase extends Form
{
    /**
     * init
     */
    protected function init()
    {
        parent::init();
        $this->addElement([
            'plugin' => 'text',
            'label'  => 'Keyword',
            'name'   => 'q',
            'class'  => 'form-control',
        ]);

        $langOptions = \App::phrase()->getLanguageOptions();

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'langId',
            'label'    => 'Language',
            'required' => true,
            'class'    => 'form-control',
            'value'    => 'en',
            'options'  => $langOptions,
        ]);
    }
}