<?php
namespace Platform\Layout\Form\Admin;

use Kendo\Html\Form;

/**
 * Class Platform\LayoutSelectBlockScript
 *
 * @package Platform\Layout\Form\Admin
 */
class LayoutSelectBlockScript extends Form
{
    protected function init()
    {
        parent::init();

        parent::init();

        $this->setTitle('Block Settings');

        $this->setNote('Block Settings');

        $this->addElement([
            'plugin'   => 'radio',
            'name'     => 'base_script',
            'value'    => 'view',
            'required' => true,
            'options'  => [],
        ]);
    }

}