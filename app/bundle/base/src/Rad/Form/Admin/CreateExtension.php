<?php
namespace Rad\Form\Admin;

use Picaso\Html\Form;

/**
 * Create new extension
 *
 * Class CreateExtension
 *
 * @package Rad\Form\Admin
 */
class CreateExtension extends Form
{
    /**
     * initialize
     */
    protected function init()
    {

        $this->setTitle('Create Extension');
        $this->setNote('Start develope a new extension by following information');

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'name',
            'class'  => 'form-control',
            'label'  => 'Name',
            'note'   => 'Lower case unique string'
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'title',
            'class'  => 'form-control',
            'label'  => 'Title',
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'title',
            'class'  => 'form-control',
            'label'  => 'Title',
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'namespace',
            'class'  => 'form-control',
            'label'  => 'Namespace',
            'note'   => 'examples: Core, Group, Event, ...'
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'path',
            'class'  => 'form-control',
            'label'  => 'Path',
            'note'   => 'examples: /base/src/Core, /base/src/Group, /base/src/Event, ...'
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'author',
            'class'  => 'form-control',
            'label'  => 'Author',
            'value'  => \App::setting('license', 'email'),
        ]);

        $this->addElement([
            'plugin' => 'text',
            'name'   => 'version',
            'class'  => 'form-control',
            'label'  => 'Version',
            'value'  => '1.0.0',
        ]);
    }
}
