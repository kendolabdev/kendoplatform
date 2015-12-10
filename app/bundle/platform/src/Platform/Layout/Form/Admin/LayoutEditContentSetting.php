<?php
namespace Platform\Layout\Form\Admin;

use Kendo\Html\Form;

/**
 * Class Platform\LayoutEditContentSetting
 *
 * @package Platform\Layout\Form\Admin
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
            'value'  => 'view'
        ]);
        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'item_script',
            'value'  => 'view',
        ]);
    }
}