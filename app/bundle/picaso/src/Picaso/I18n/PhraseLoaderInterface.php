<?php

namespace Picaso\I18n;

/**
 * Interface PhraseLoaderInterface
 *
 * @package Picaso\I18n
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