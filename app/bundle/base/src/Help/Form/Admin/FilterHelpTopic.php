<?php
namespace Help\Form\Admin;


use Picaso\Html\Form;

/**
 * Class FilterHelpTopic
 *
 * @package Help\Form\Admin
 */
class FilterHelpTopic extends Form
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

        $this->addElement([
            'plugin'  => 'select',
            'name'    => 'category',
            'label'   => 'Category',
            'class'   => 'form-control',
            'options' => \App::help()->loadAdminCategoryOptions(),
        ]);

    }
}