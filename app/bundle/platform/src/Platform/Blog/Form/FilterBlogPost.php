<?php

namespace Platform\Blog\Form;

use Kendo\Html\Form;

/**
 * Class FilterBlogPost
 *
 * @package Base\Blog\Form
 */
class FilterBlogPost extends Form
{

    /**
     * init
     */
    protected function init()
    {
        parent::init();
        $this->addElement([
            'plugin'      => 'text',
            'label'       => 'Keyword',
            'placeholder' => 'Title',
            'name'        => 'q',
            'class'       => 'form-control',
        ]);


        $this->addElement([
            'plugin'  => 'select',
            'name'    => 'category',
            'label'   => 'Category',
            'class'   => 'form-control',
            'options' => app()->blogService()->getCategoryOptions(),
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