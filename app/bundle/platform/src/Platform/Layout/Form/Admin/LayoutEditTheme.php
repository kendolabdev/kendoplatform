<?php

namespace Platform\Layout\Form\Admin;

use Kendo\Html\Form;

/**
 * Class Platform\LayoutEditTheme
 *
 * @package Platform\Layout\Form\Admin
 */
class LayoutEditTheme extends Form
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Edit Theme');

        $this->addElement([
            'plugin' => 'static',
            'name'   => 'theme_id',
            'label'  => 'ID',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_active',
            'label'  => 'Active',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_default',
            'label'  => 'Default',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_editing',
            'label'  => 'Is In Editing Mode',
            'note'   => 'Choose "Yes" to start edit this theme',
        ]);
    }
}