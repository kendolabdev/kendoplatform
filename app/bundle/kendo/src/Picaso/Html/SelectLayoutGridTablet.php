<?php

namespace Picaso\Html;

/**
 * Class SelectLayoutGridTablet
 *
 * @package Picaso\Html
 */
class SelectLayoutGridTablet extends SelectField
{
    /**
     * @var bool
     */
    protected $required = true;

    /**
     * Available options
     *
     * @var array
     */
    protected $options = [
        ['value' => 'col-sm-12', 'label' => 'Single item per row'],
        ['value' => 'col-sm-6', 'label' => '2 items per row'],
        ['value' => 'col-sm-4', 'label' => '3 items per row'],
        ['value' => 'col-sm-3', 'label' => '4 items per row'],
        ['value' => 'col-sm-2', 'label' => '6 items per row'],
    ];

    protected function init()
    {
        parent::init();

        $this->setLabel('core.layout_grid_tablet');
        $this->setNote('core.layout_grid_tablet_note');
        $this->setName('grid_sm');
    }
}