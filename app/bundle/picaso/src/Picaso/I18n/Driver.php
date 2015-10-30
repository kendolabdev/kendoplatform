<?php

namespace Picaso\I18n;

/**
 * Interface Driver
 *
 * @package Picaso\I18n
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