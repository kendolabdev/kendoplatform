<?php
namespace Layout\Form\Admin;

use Picaso\Html\Form;

/**
 * Class LayoutSelectBlockScript
 *
 * @package Layout\Form\Admin
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
            'value'    => 'render1',
            'required' => true,
            'options'  => [],
        ]);
    }

}