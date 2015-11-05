<?php

namespace Layout\Form\Admin;

use Picaso\Html\Form;

/**
 * Class LayoutEditTheme
 *
 * @package Layout\Form\Admin
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
            'plugin' => 'static',
            'name'   => 'template_id',
            'label'  => 'Template ID',
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