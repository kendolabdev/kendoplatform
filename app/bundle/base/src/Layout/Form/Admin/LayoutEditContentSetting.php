<?php
namespace Layout\Form\Admin;

use Picaso\Html\Form;

/**
 * Class LayoutEditContentSetting
 *
 * @package Layout\Form\Admin
 */
class LayoutEditContentSetting extends Form
{
    /**
     * Callback at ended constructor.
     */
    protected function init()
    {
        $this->setTitle('core_layout.edit_layout');
        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'base_script',
            'value'  => 'render1'
        ]);
        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'item_script',
            'value'  => 'render1',
        ]);
    }
}