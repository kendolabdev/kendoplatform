<?php

namespace Kendo\Html;

/**
 * Class SelectLayoutMediaBorder
 *
 * @package Kendo\Html
 */
class SelectLayoutMediaBorder extends SelectField
{
    /**
     * @var bool
     */
    protected $required = true;

    /**
     * @var string
     */
    protected $value = 'card-border-none';

    /**
     * Available options
     *
     * @var array
     */
    protected $options = [
        ['value' => 'card-border-none', 'label' => 'No border'],
        ['value' => 'card-border-bottom', 'label' => 'Border bottom each item'],
        ['value' => 'card-border-all', 'label' => 'Border fit around content'],
    ];

    protected function init()
    {
        parent::init();

        $this->setLabel('core.layout_card_border');
        $this->setNote('core.layout_card_border_note');
        $this->setName('card_border');
    }


}