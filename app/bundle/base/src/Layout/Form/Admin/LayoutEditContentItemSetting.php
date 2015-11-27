<?php
namespace Layout\Form\Admin;

use Picaso\Html\Form;

/**
 * Class LayoutEditContentItemSetting
 *
 * @package Layout\Form\Admin
 */
class LayoutEditContentItemSetting extends Form
{
    /**
     * Callback at ended constructor.
     */
    protected function init()
    {
        $this->setTitle('core_layout.edit_layout');
        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'item_script',
            'value'  => 'view'
        ]);
    }
}