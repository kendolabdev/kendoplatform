<?php
namespace Layout\Form\Admin;

use Picaso\Html\Form;

/**
 * Class LayoutSupportBlockSetting
 *
 * @package Layout\Form\Admin
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
            'value'    => 'render1',
            'required' => true,
        ]);
    }

}