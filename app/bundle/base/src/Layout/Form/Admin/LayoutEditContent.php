<?php
namespace Layout\Form\Admin;

use Picaso\Html\Form;


/**
 * Class LayoutEditContent
 *
 * @package Layout\Form\Admin
 */
class LayoutEditContent extends Form
{
    /**
     * Callback at ended constructor.
     */
    protected function init()
    {
        $this->setTitle('core_layout.edit_layout');
    }
}