<?php

namespace Picaso\Assets;

/**
 * Interface Collection
 *
 * @package Picaso\Assets
 */
interface Collection
{

    /**
     * @return string
     */
    public function render();

    /**
     * @return string
     */
    public function __toString();
}