<?php

namespace Kendo\Html;


/**
 * Class SelectLayoutMediaPosition
 *
 * @package Kendo\Html
 */
class SelectLayoutMediaPosition extends SelectField
{
    /**
     * @var bool
     */
    protected $required = true;

    /**
     * @var string
     */
    protected $value = 'media-top';

    /**
     * Available options
     *
     * @var array
     */
    protected $options = [
        ['value' => 'media-top', 'label' => 'Image at top'],
        ['value' => 'media-aside-left', 'label' => 'Image at left'],
        ['value' => 'media-overlay', 'label' => 'Overlay content'],
    ];

    protected function init()
    {
        parent::init();

        $this->setName('media_position');
        $this->setLabel('core.layout_media_render');
        $this->setNote('core.layout_media_render_note');
    }
}