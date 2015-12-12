<?php

namespace Kendo\Html;

/**
 * Class SelectLayoutMediaRatio
 *
 * @package Kendo\Html
 */
class SelectLayoutMediaRatio extends SelectField
{
    /**
     * @var bool
     */
    protected $required = true;

    /**
     * @var string
     */
    protected $value = 'media-ratio-85';

    /**
     * Available options
     *
     * @var array
     */
    protected $options = [
        ['value' => 'media-ratio-11', 'label' => 'Square Image - 1:1'],
        ['value' => 'media-ratio-85', 'label' => 'Golden Ratio - 8:5'],
        ['value' => 'media-ratio-169', 'label' => 'Film Ratio - 16:9'],
        ['value' => 'media-ratio-43', 'label' => 'Ratio - 4:3'],
        ['value' => 'media-ratio-21', 'label' => 'Ratio - 2.1'],
    ];

    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setLabel('core.layout_media_ratio');
        $this->setNote('core.layout_media_ratio_note');
        $this->setName('media_ratio');
    }
}