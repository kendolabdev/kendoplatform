<?php

namespace Platform\Phrase\Form\Admin;

use Kendo\Html\Form;

/**
 * Class FilterPhrase
 *
 * @package Platform\Phrase\Form\Admin
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

        $langOptions = app()->phraseService()->getLanguageOptions();

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