<?php
namespace Help\Form\Admin;


use Picaso\Html\Form;

/**
 * Class FilterHelpPage
 *
 * @package Help\Form\Admin
 */
class FilterHelpPage extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->addElement([
            'plugin' => 'text',
            'name'   => 'q',
            'label'  => 'Keyword',
            'class'  => 'form-control',
        ]);
    }
}