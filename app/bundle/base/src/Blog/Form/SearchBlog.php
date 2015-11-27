<?php
namespace Blog\Form;

use Picaso\Html\Form;

/**
 * Class SearchBlog
 *
 * @package Blog\Form
 */
class SearchBlog extends Form
{

    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setAction(\App::routingService()->getUrl('blogs'));

        $this->setMethod('get');

        $this->addElement([
            'plugin'      => 'text',
            'label'       => 'core.keyword',
            'name'        => 'q',
            'placeholder' => 'blog.search_blogs',
            'class'       => 'form-control'
        ]);

        $this->addElement([
            'plugin'   => 'select',
            'name'     => 'order',
            'required' => true,
            'label'    => 'Browse by',
            'options'  => [
                ['value' => 'recent', 'label' => 'Recent'],
            ],
            'value'    => 'recent',
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin' => 'submit',
            'label'  => 'core.search',
            'class'  => 'btn btn-primary',
        ]);

        $this->setData($_GET);
    }

}