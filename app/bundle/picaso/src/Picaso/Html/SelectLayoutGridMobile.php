<?php

namespace Picaso\Html;

/**
 * Class SelectLayoutGridTablet
 *
 * @package Picaso\Html
 */
class SelectLayoutGridMobile extends SelectField
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
        ['value' => 'col-xs-12', 'label' => 'Single item per row'],
        ['value' => 'col-xs-6', 'label' => '2 items per row'],
        ['value' => 'col-xs-4', 'label' => '3 items per row']
    ];

    protected function init()
    {
        parent::init();

        $this->setLabel('core.layout_grid_mobile');
        $this->setNote('core.layout_grid_mobile_note');
        $this->setName('grid_xs');
    }
}