<?php

namespace Kendo\I18n;

/**
 * Interface PhraseLoaderInterface
 *
 * @package Kendo\I18n
 */
interface PhraseLoaderInterface
{

    /**
     * @param $language
     *
     * @return array
     */
    public function load($language);
}