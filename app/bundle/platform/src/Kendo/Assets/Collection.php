<?php

namespace Kendo\Assets;

/**
 * Interface Collection
 *
 * @package Kendo\Assets
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