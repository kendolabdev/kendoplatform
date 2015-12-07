<?php
namespace Help\Form\Admin;


use Kendo\Html\Form;

/**
 * Class FilterHelp
 *
 * @package Help\Form\Admin
 */
class FilterHelpPost extends Form
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
            'name'    => 'topic',
            'label'   => 'Topic',
            'class'   => 'form-control',
            'options' => \App::helpService()->loadAdminTopicOptions(),
        ]);
    }
}