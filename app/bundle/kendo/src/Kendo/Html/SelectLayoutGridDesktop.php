<?php

namespace Kendo\Html;

/**
 * Class SelectLayoutGridDesktop
 *
 * @package Kendo\Html
 */
class SelectLayoutGridDesktop extends SelectField
{
    /**
     * @var bool
     */
    protected $required = true;

    /**
     * @var string
     */
    protected $value = 'col-md-6';

    /**
     * Available options
     *
     * @var array
     */
    protected $options = [
        ['value' => 'col-md-12', 'label' => 'Single item per row'],
        ['value' => 'col-md-6', 'label' => '2 items per row'],
        ['value' => 'col-md-4', 'label' => '3 items per row'],
        ['value' => 'col-md-3', 'label' => '4 items per row'],
        ['value' => 'col-md-2', 'label' => '6 items per row'],
    ];

    protected function init()
    {
        parent::init();

        $this->setLabel('core.layout_grid_desktop');
        $this->setNote('core.layout_grid_desktop_note');
        $this->setName('grid_md');
    }
}

