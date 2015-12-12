<?php

namespace Platform\Blog\Form\Admin;

use Kendo\Html\Form;

/**
 * Class FilterBlogPost
 *
 * @package Base\Blog\Form\Admin
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
            'plugin' => 'text',
            'label'  => 'Keyword',
            'name'   => 'q',
            'class'  => 'form-control',
        ]);


        $this->addElement([
            'plugin'  => 'select',
            'name'    => 'category',
            'label'   => 'Category',
            'class'   => 'form-control',
            'options' => \App::blogService()->getAdminCategoryOptions(),
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'approve',
            'label'    => 'Approval',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => 'all', 'label' => 'All'],
                ['value' => '0', 'label' => 'No'],
                ['value' => '1', 'label' => 'Approved'],
            ]
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'active',
            'label'    => 'Active',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => 'all', 'label' => 'All'],
                ['value' => '0', 'label' => 'No'],
                ['value' => '1', 'label' => 'Active'],
            ]
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'created',
            'label'    => 'Created',
            'class'    => 'form-control',
            'required' => true,
            'options'  => [
                ['value' => 'all', 'label' => 'All'],
                ['value' => '1hour', 'label' => '60 minutes'],
                ['value' => 'today', 'label' => 'Today'],
                ['value' => '24hours', 'label' => '24 hours'],
                ['value' => '7days', 'label' => '7 days'],
                ['value' => '30days', 'label' => '30 days'],
                ['value' => 'this_month', 'label' => 'This month'],
                ['value' => '30days', 'label' => 'This year'],
            ]
        ]);
    }
}