<?php
namespace Platform\Layout\Form\Admin;

use Kendo\Html\Form;


/**
 * Class Platform\LayoutEditContent
 *
 * @package Platform\Layout\Form\Admin
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