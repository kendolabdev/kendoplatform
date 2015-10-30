<?php

namespace Picaso\Html;

/**
 * Class SelectLayoutMediaAutoload
 *
 * @package Picaso\Html
 */
class SelectLayoutMediaAutoload extends YesnoField
{
    /**
     * @var bool
     */
    protected $required = true;

    /**
     * @var string
     */
    protected $value = '0';

    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setLabel('core.layout_content_endless_load');
        $this->setNote('core.layout_content_endless_load_node');
        $this->setName('endless');
    }
}