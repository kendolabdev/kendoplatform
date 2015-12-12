<?php

namespace Kendo\I18n;

/**
 * Interface Driver
 *
 * @package Kendo\I18n
 */
interface Driver
{

    /**
     * @param array $params
     */
    public function __construct($params);

    /**
     * @return mixed
     */
    public function loadPhrases();
}