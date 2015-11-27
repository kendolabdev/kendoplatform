<?php

namespace Photo\Form;

use Picaso\Html\Form;

/**
 * Class FilterPhoto
 *
 * @package Photo\Form
 */
class FilterPhoto extends Form
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
            'placeholder'=> 'Title',
            'name'   => 'q',
            'class'  => 'form-control',
        ]);


        $this->addElement([
            'plugin'  => 'select',
            'name'    => 'category',
            'label'   => 'Category',
            'class'   => 'form-control',
            'options' => \App::blogService()->getCategoryOptions(),
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'created',
            'label'    => 'Created',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => 'all', 'label' => 'All'],
                ['value' => 'today', 'label' => 'Today'],
                ['value' => '7days', 'label' => 'This week'],
                ['value' => 'this_month', 'label' => 'This month'],
            ]
        ]);
    }
}