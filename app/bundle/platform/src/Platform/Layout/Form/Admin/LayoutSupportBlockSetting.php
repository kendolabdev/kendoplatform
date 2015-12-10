<?php
namespace Platform\Layout\Form\Admin;

use Kendo\Html\Form;

/**
 * Class Platform\LayoutSupportBlockSetting
 *
 * @package Platform\Layout\Form\Admin
 */
class LayoutSupportBlockSetting extends Form
{
    /**
     * Overwrite init method
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('Block Settings');

        $this->setNote('Block Settings');

        $this->addElement([
            'plugin'   => 'hidden',
            'name'     => 'base_script',
            'value'    => 'view',
            'required' => true,
        ]);
    }

}