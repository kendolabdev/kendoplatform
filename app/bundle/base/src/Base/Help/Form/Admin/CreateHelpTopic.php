<?php

namespace Base\Help\Form\Admin;

use Kendo\Html\Form;

/**
 * Class CreateHelpTopic
 *
 * @package Help\Form\Admin
 */
class CreateHelpTopic extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Create New Topic');
        $this->setNote('Create new help topic');

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'category_id',
            'label'    => 'Category',
            'class'    => 'form-control',
            'required' => true,
            'options'  => \App::helpService()->loadAdminCategoryOptions(),
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'topic_title',
            'label'    => 'Name',
            'class'    => 'form-control',
            'required' => true,
        ]);

        $this->addElement([
            'plugin'   => 'textarea',
            'name'     => 'topic_description',
            'label'    => 'Description',
            'class'    => 'form-control',
            'required' => true,
        ]);


        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'topic_active',
            'label'  => 'Publish?',
            'value'  => '1',
        ]);
    }
}